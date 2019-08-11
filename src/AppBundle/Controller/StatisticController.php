<?php

namespace AppBundle\Controller;

use AppBundle\Document\Statistic;
use Symfony\Component\HttpFoundation\Request;

class StatisticController extends BaseController
{
    public function indexAction($urlId)
    {
        $statistics = $this->dm->getRepository(Statistic::class)->findBy([
            'shortUrl' => $urlId,
        ]);

        return $this->render('@App/statistic.html.twig', [
            'statistic' => $statistics,
        ]);
    }
}