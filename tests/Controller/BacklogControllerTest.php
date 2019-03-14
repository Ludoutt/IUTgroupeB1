<?php

/*
 * Pull your hearder here, for exemple, Licence header.
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class BacklogControllerTest extends WebTestCase
{
    /**
     * @dataProvider getUrls
     */
    public function testPageAvailability(string $httpMethod, string $url, array $parameters = [])
    {
        $client = static::createClient();

        $client->request('GET', '/');
        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());

        $client->request($httpMethod, $url, $parameters);
        $this->assertContains($client->getResponse()->getStatusCode(), [
            Response::HTTP_OK,
            Response::HTTP_FOUND
        ]);
    }

    public function getUrls()
    {
        yield ['GET', '/backlog'];
        yield ['GET', '/backlog/new'];
        yield ['POST', '/backlog/new'];
        yield ['GET', '/backlog/1/edit'];
        yield ['POST', '/backlog/1/edit'];
        yield ['DELETE', '/backlog/1'];
        yield ['GET', '/backlog/1/move-up'];
        yield ['GET', '/backlog/1/move-down'];
        yield ['POST', '/backlog/apply-transition/1', ['transition' => 'accept']];
        yield ['POST', '/backlog/reset-status/1'];
    }
}
