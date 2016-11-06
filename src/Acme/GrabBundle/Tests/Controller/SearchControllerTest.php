<?php

namespace Acme\GrabBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SearchControllerTest extends WebTestCase
{
    public function testResult()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/result');
    }

}
