<?php

namespace Acme\WeatherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Acme\WeatherBundle\Entity\CodeWeather;
use Acme\WeatherBundle\Entity\Endpoint;
use Acme\WeatherBundle\Parser\Parser;
use Acme\WeatherBundle\Parser\Geocoding;

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

        $geocoding = new Geocoding();
        $geoData = $geocoding->findGeodata($city);

        $sum_temp = 0;
        $sum_pressure = 0;
        $weather_descs = array();
        $wind_directions = array();
        $sum_wind_speed = 0;

        $parser = new Parser();

        $endpoints_count = 0;
        foreach($endpoints as $en){

            $weather_info = $parser->$en['parser']($en['endpoint'], $geoData);

            if (is_array($weather_info)){
                $sum_temp += $weather_info['temp'];

                if(array_key_exists('weather_code', $weather_info)){
                    $weathercode = $em->getRepository('AcmeWeatherBundle:CodeWeather')->getCodeDescription($weather_info['weather_code']);
                    $weather_descs[] = $weathercode[0]['description'];
                }
                else{
                    $weather_descs[] = $weather_info['weather_desc'];
                }

                $sum_pressure += $weather_info['pressure'];
                $wind_directions[] = $weather_info['wind_direction'];
                $sum_wind_speed += $weather_info['wind_speed'];

                $endpoints_count++;
            }
        }
//        echo '<pre>';
//        print_r($geoData);
//        echo '</pre>';

        $output_array = array();

        $average_temp = $sum_temp / $endpoints_count;
        $output_array['temp'] = round($average_temp);

        $weather_descs_count = array_count_values($weather_descs);
        foreach($weather_descs_count as &$desc_count){
            $percent = ($desc_count * 100)/$endpoints_count;
            $desc_count = round($percent, 2) . "%";
        }
        $output_array['weather_desc'] = $weather_descs_count;

        $average_pressure = $sum_pressure / $endpoints_count;
        $output_array['pressure'] = round($average_pressure);

        $wind_directions_count = array_count_values($wind_directions);
        foreach($wind_directions_count as &$dir_count){
            $percent = ($dir_count * 100) / $endpoints_count;
            $dir_count = round($percent, 2) . "%";
        }
        $output_array['wind_direction'] = $wind_directions_count;

        $average_wind_speed = $sum_wind_speed / $endpoints_count;
        $output_array['wind_speed'] = round($average_wind_speed, 2);

        $output_json = json_encode($output_array);

//        $response = new Response($output_json);
//        $response->headers->set('Content-Type', 'application/json');
//        return $response;

        return $this->render('AcmeWeatherBundle:Default:weatherCity.json.twig', array('json' => $output_json));
    }
}
