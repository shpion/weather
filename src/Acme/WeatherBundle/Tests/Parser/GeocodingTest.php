<?php
namespace Acme\WeatherBundle\Tests\Parser;

use Acme\WeatherBundle\Parser\Geocoding;

class DefaultControllerTes  extends \PHPUnit_Framework_TestCase
{
    public function testFindGeodata(){

        $geocoding = new Geocoding();

        $city = "Moscow";

        $result = $geocoding->findGeodata($city);

        $this->assertArrayHasKey("country", $result);
    }
}