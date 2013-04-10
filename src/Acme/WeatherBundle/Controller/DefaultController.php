<?php

namespace Acme\WeatherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AcmeWeatherBundle:Default:index.html.twig');
    }

    public function weatherCityAction($city){



        return $this->render('AcmeWeatherBundle:Default:weatherCity.json.twig', array('city' => $city));
    }
}
