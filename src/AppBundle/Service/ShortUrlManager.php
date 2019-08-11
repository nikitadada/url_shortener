<?php

namespace AppBundle\Service;

use AppBundle\Document\ShortUrl;
use Doctrine\ODM\MongoDB\DocumentManager;

class ShortUrlManager
{
    /** @var $dm DocumentManager */
    private $dm;

    /** @var BijectiveFunction $bijective */
    private $bijectiveFunction;


    public function __construct(DocumentManager $dm, BijectiveFunction $bijectiveFunction)
    {
        $this->dm = $dm;
        $this->bijectiveFunction = $bijectiveFunction;
    }

    public function create(ShortUrl $shortUrl): string
    {
        $this->dm->persist($shortUrl);
        $this->dm->flush();

        $alias = $this->bijectiveFunction->encode($shortUrl->getId());

        $shortUrl->setAlias($alias);

        $this->dm->flush();

        return $alias;
    }

}