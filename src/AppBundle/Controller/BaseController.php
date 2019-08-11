<?php

namespace AppBundle\Controller;

use AppBundle\Container\ContainerWrapper;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormInterface;

class BaseController extends Controller
{
    /**
     * @var ContainerWrapper
     */
    protected $container;

    /**
     * @var DocumentManager
     */
    protected $dm;


    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container->get(ContainerWrapper::class);
        $this->dm = $this->container->getDocumentManager();
    }

    protected function createForm($type, $data = null, array $options = [])
    {
        $options = array_merge(['csrf_protection' => false, 'allow_extra_fields' => true], $options);

        $builder = $this
            ->container
            ->getFormFactory()
            ->createNamedBuilder('', $type, $data, $options);

        $builder->setMethod('POST');

        return $builder->getForm();
    }

    protected function isValidForm(FormInterface $form)
    {
        return $form->isSubmitted() && $form->isValid();
    }
}