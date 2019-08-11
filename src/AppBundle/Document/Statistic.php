<?php

namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as Mongo;

/**
 * @Mongo\Document(collection="statistics")
 */
class Statistic
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
     * @Mongo\Field(type="string")
     */
    private $geoInformation;

    /**
     * @Mongo\Field(type="string")
     */
    private $userAgent;

    /**
     * @Mongo\ReferenceOne(targetDocument="ShortUrl", storeAs="id")
     * @var ShortUrl
     */
    private $shortUrl;


    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getGeoInformation(): string
    {
        return $this->geoInformation;
    }

    public function setGeoInformation($geoInformation)
    {
        $this->geoInformation = $geoInformation;

        return $this;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    public function getShortUrl(): ShortUrl
    {
        return $this->shortUrl;
    }

    public function setShortUrl(ShortUrl $shortUrl)
    {
        $this->shortUrl = $shortUrl;

        return $this;
    }


}