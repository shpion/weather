<?php

namespace Acme\WeatherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Acme\WeatherBundle\Entity\CodeWeather;
use Acme\WeatherBundle\Entity\Endpoint;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AcmeWeatherBundle:Default:index.html.twig');
    }

    public function weatherCityAction($city){
//        $string = file_get_contents(__DIR__ ."/weatherCode.txt");
//        $codes = explode("	", $string);

//        echo '<pre>';
//        print_r($codes);
//        echo '</pre>';

//        $k = 0;
//        $weatherCode = new CodeWeather();
//        foreach($codes as $code){
//            if ($k === 0){
//                $weatherCode->setCode((int)$code);
//                $k++;
//            }
//            elseif($k == 1){
//                $weatherCode->setDescription($code);
//                $k++;
//            }
//            elseif($k == 2){
//                $weatherCode->setDayIcon($code);
//                $k++;
//            }
//            else{
//                $weatherCode->setNightIcon($code);
//                $k++;
//            }
//
//            if($k == 4){
//                $em = $this->getDoctrine()->getManager();
//                $em->persist($weatherCode);
//                $em->flush();
//                $weatherCode = new CodeWeather();
//                $k = 0;
//            }
//        }
        $em = $this->getDoctrine()->getManager();
        $endpoints = $em->getRepository('AcmeWeatherBundle:Endpoint')->getAllEndpoins();

        $sum_max_temp = 0;
        $sum_min_temp = 0;

        $endpoints_count = count($endpoints);
        $fallout = array();
        foreach($endpoints as $en){
            $endpoint = str_replace('{city}', $city, $en['endpoint']);

            $curl = curl_init($endpoint);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            $json = curl_exec($curl);

            switch ($en['parser']){
                case 1: $weather_info = array ('max_temp' => 25, 'min_temp' => -5, 'weather_code' => 113); //parse json
                    break;
                case 2: $weather_info = array ('max_temp' => 23, 'min_temp' => -7, 'weather_code' => 116); //parse json
                    break;
                case 3: $weather_info = array ('max_temp' => 27, 'min_temp' => -10, 'weather_code' => 113); //parse json
                    break;
                default:
                    $weather_info = "Parser not found";
            }

            if (is_array($weather_info)){
                $sum_max_temp += $weather_info['max_temp'];
                $sum_min_temp += $weather_info['min_temp'];

                $weathercode = $em->getRepository('AcmeWeatherBundle:CodeWeather')->getCodeDescription($weather_info['weather_code']);
                $fallout[] = $weathercode[0]['description'];
            }
        }

//        echo '<pre>';
//        print_r($fallout);
//        echo '</pre>';

        $output_array = array();

        $average_max_temp = $sum_max_temp / $endpoints_count;
        $average_min_temp = $sum_min_temp / $endpoints_count;
        $output_array['average_max_temp'] = round($average_max_temp);
        $output_array['average_min_temp'] = round($average_min_temp);

        $fallouts_count = array_count_values($fallout);
        foreach($fallouts_count as &$fall_count){
            $percent = ($fall_count * 100)/$endpoints_count;
            $fall_count = round($percent, 2) . "%";
        }
        $output_array['fallout'] = $fallouts_count;

        $output_json = json_encode($output_array);

        return $this->render('AcmeWeatherBundle:Default:weatherCity.json.twig', array('json' => $output_json));
    }
}
