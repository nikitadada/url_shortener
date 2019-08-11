<?php

namespace Tests\AppBundle\Service;

use AppBundle\Service\BijectiveFunction;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class BijectiveFunctionTest extends TestCase
{
    public function testEncode()
    {
        $calculator = new BijectiveFunction();
        $result = $calculator->encode(62);

        $this->assertEquals('BA', $result);
    }

    public function testDecode()
    {
        $calculator = new BijectiveFunction();
        $result = $calculator->decode('BA');

        $this->assertEquals(62, $result);
    }
}