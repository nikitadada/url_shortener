<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StatisticControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/statistic/199');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Url statistic', $crawler->filter('.sidebar-heading')->text());
    }
}