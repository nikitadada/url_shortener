<?php

namespace AppBundle\Container;

use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ContainerWrapper
{
    private $container;


    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function has($id)
    {
        return $this->container->has($id);
    }

    public function get($id, $invalidBehavior = ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE)
    {
        return $this->container->get($id, $invalidBehavior);
    }

    public function getMongo()
    {
        return $this->get('doctrine_mongodb');
    }

    /**
     * @return DocumentManager
     */
    public function getDocumentManager()
    {
        return $this->getMongo()->getManager();
    }

    public function getFormFactory()
    {
        return $this->container->get('form.factory');
    }

}
