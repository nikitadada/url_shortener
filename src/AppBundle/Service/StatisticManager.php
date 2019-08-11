<?php

namespace AppBundle\Service;

use AppBundle\Document\ShortUrl;
use AppBundle\Document\Statistic;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\Request;

class StatisticManager
{
    /** @var $dm DocumentManager */
    private $dm;

    const GEO_SERVICE_URL = 'http://ip-api.com/php';


    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }

    public function create(Request $request, ShortUrl $shortUrl): void
    {
        $statistic = new Statistic();

        $ip = $request->getClientIp();

        $statistic
            ->setShortUrl($shortUrl)
            ->setGeoInformation($this->getGeoInformation($ip))
            ->setUserAgent($this->getBrowserAndOs());

        $this->dm->persist($statistic);
        $this->dm->flush();

    }

    private function getBrowserAndOs(): string
    {
        try {
            $browser = get_browser(null, true);
            $info = sprintf('%s, %s %s', $browser['platform'], $browser['browser'], $browser['version']);
        } catch (\Exception $e) {
            $info = $_SERVER['HTTP_USER_AGENT'];
        }

        return $info;
    }

    private function getGeoInformation($ip)
    {
        $result = @unserialize(file_get_contents(sprintf('%s/%s', self::GEO_SERVICE_URL, $ip)));

        if ($result && $result['status'] === 'success') {
            $result = sprintf('%s, %s, %s', $result ['country'], $result['regionName'], $result['city']);
        } else {
            $result = $ip;
        }

        return $result;
    }
}