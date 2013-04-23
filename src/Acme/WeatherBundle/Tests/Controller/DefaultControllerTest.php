<?php

namespace Acme\WeatherBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/weather/London');

        $this->assertTrue($crawler->filter('html:contains("average_max_temp")')->count() > 0);
    }

//    public function testWeatherCity(){
//        $controller = new Controller();
//        $result = $controller->weatherCityAction('London');
//
//        $this->assertEquals(42, $result);
//    }
}
