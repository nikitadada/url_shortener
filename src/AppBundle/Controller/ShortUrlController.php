<?php

namespace AppBundle\Controller;

use AppBundle\Document\ShortUrl;
use AppBundle\Exception\UrlExpiredException;
use AppBundle\Form\ShortUrlType;
use AppBundle\Service\BijectiveFunction;
use AppBundle\Service\ShortUrlManager;
use AppBundle\Service\StatisticManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ShortUrlController extends BaseController
{
    public function indexAction(Request $request)
    {
        $shortUrl = new ShortUrl();

        $form = $this->createForm(ShortUrlType::class, $shortUrl);
        $form->handleRequest($request);

        if ($this->isValidForm($form)) {
            $manager = $this->container->get(ShortUrlManager::class);

            $alias = $manager->create($shortUrl);
            $link = sprintf('%s/%s', $request->getSchemeAndHttpHost(), $alias);

            $statisticLink = sprintf('%s/statistic/%s', $request->getSchemeAndHttpHost(), $shortUrl->getId());

            $this->addFlash('success', sprintf('Ваша укороченная ссылка: %s', $link));
            $this->addFlash('success', sprintf('Ссылка на статистику посещений: %s', $statisticLink));
        }

        return $this->render('@App/short_url.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function redirectAction($alias, BijectiveFunction $bijectiveFunction, Request $request)
    {
        $id = $bijectiveFunction->decode($alias);
        $shortUrl = $this->dm->getRepository(ShortUrl::class)->find($id);

        if ($shortUrl) {
            if ($shortUrl->getExpiresAt() && $shortUrl->getExpiresAt() < new \DateTime()) {
                throw new UrlExpiredException();
            }

            $statisticManager = $this->container->get(StatisticManager::class);
            $statisticManager->create($request, $shortUrl);

            return $this->redirect($shortUrl->getOriginalUrl(), 308);
        } else {
            throw new NotFoundHttpException('Sorry, not existing!');
        }
    }
}