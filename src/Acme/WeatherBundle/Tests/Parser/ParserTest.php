<?php
namespace Acme\WeatherBundle\Tests\Parser;

use Acme\WeatherBundle\Parser\Parser;

class DefaultControllerTest  extends \PHPUnit_Framework_TestCase
{
    public function testWwoWeather(){

        $parser = new Parser();

        $url = "http://api.worldweatheronline.com/free/v1/weather.ashx?q={city}&key=rcna5mxsukzzaezsrqpfc7n9&format=json";
        $geoData = array('city' => 'Moscow','country' => 'RU', 'lat' => 55.7512419, 'lng' => 37.6184217);

        $result = $parser->wwoWeather($url, $geoData);

        $this->assertArrayHasKey("temp", $result);
    }

    public function testAerisapiWeather(){

        $parser = new Parser();

        $url = "http://api.aerisapi.com/observations/{city}?client_id=codTOUHgeC3MMjDtkK6H2&client_secret=HdAN1HcMqlPIs0qglkADp8ZbLT2i1ytQCPfj5Tbf";
        $geoData = array('city' => 'Moscow','country' => 'RU', 'lat' => 55.7512419, 'lng' => 37.6184217);

        $result = $parser->aerisapiWeather($url, $geoData);

        $this->assertArrayHasKey("temp", $result);
    }

    public function testForecastWeather(){

        $parser = new Parser();

        $url = "https://api.forecast.io/forecast/004fc5d87fb7331beb06702bf4a2e3bc/{city}";
        $geoData = array('city' => 'Moscow','country' => 'RU', 'lat' => 55.7512419, 'lng' => 37.6184217);

        $result = $parser->aerisapiWeather($url, $geoData);

        $this->assertArrayHasKey("temp", $result);
    }
}