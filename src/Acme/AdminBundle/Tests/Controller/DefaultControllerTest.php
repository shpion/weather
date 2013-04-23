<?php

namespace Acme\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/');

        $form = $crawler->selectButton('submit')->form();

        $form['enabled'] = 1;
        $form['serviceName'] = 'Test Name';
        $form['endpoint'] = 'Test Endpoint';
        $form['parser'] = 'Test Parser';

        $crawler = $client->submit($form);

//        $this->assertTrue($crawler->filter('html:contains("Hello Fabien")')->count() > 0);
    }
}
