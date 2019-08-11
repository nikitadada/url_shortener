<?php

namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as Mongo;

/**
 * @Mongo\Document(collection="urls")
 */
class ShortUrl
{
    /**
     * @Mongo\Id(strategy="INCREMENT")
     */
    private $id;

    /**
     * @var \DateTime
     * @Mongo\Field(type="date")
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @Mongo\Field(type="date")
     */
    private $expiresAt;

    /**
     * @Mongo\Field(type="string")
     */
    private $originalUrl;

    /**
     * @Mongo\Field(type="string")
     */
    private $alias;


    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getOriginalUrl()
    {
        return $this->originalUrl;
    }

    public function setOriginalUrl($originalUrl)
    {
        $this->originalUrl = $originalUrl;

        return $this;
    }

    public function getAlias()
    {
        return $this->alias;
    }

    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    public function setExpiresAt($expiresAt)
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

}