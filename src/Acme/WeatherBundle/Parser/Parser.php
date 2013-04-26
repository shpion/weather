<?php

namespace Acme\WeatherBundle\Parser;

use Symfony\Component\HttpFoundation\Response;

class Parser
{
    public function wwoWeather($url, $geoData){
//      http://api.worldweatheronline.com/free/v1/weather.ashx?q={city}&key=rcna5mxsukzzaezsrqpfc7n9&format=json

        $url = str_replace('{city}', $geoData['city'] . ',' . $geoData['country'], $url);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($curl);

        $jsonWeather = json_decode($result);

        if(isset($jsonWeather->data->current_condition[0])){
            $weather = $jsonWeather->data->current_condition[0];
            $weatherObject = array();
            $weatherObject['location'] = $jsonWeather->data->request[0]->query;
            $weatherObject['temp'] = $weather->temp_C;
            $weatherObject['weather_desc'] = $weather->weatherDesc[0]->value;
            $weatherObject['pressure'] = $weather->pressure;
            $weatherObject['wind_direction'] = $weather->winddir16Point;
            $weatherObject['wind_speed'] = $weather->windspeedKmph;
            return $weatherObject;
        }

        return null;
    }

    public function aerisapiWeather($url, $geoData){
//      http://api.aerisapi.com/observations/{city}?client_id=codTOUHgeC3MMjDtkK6H2&client_secret=HdAN1HcMqlPIs0qglkADp8ZbLT2i1ytQCPfj5Tbf

        $url = str_replace('{city}', $geoData['city'] . ',' . $geoData['country'], $url);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($curl);


        $json = json_decode($result);
        if ($json->success == true) {
            $weather = $json->response->ob;
            $weatherObject = array();
            $weatherObject['location'] = $json->response->profile->tz;
            $weatherObject['temp'] = $weather->tempC;
            $weatherObject['weather_desc'] = $weather->weather;
            $weatherObject['pressure'] = $weather->pressureMB;
            $weatherObject['wind_direction'] = $weather->windDir;
            $weatherObject['wind_speed'] = $weather->windSpeedKPH;
            return $weatherObject;
        }

        return null;
    }

    public function forecastWeather($url, $geoData){
//      https://api.forecast.io/forecast/004fc5d87fb7331beb06702bf4a2e3bc/{city}
//        $url = str_replace('{city}', $geoData['lat'] . ',' . $geoData['lng'], $url);
        $url = "https://api.forecast.io/forecast/7b6da4e5ca4ef6e649e40cef4f88d2ac/37.8267,-122.423";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($curl);

        $json = json_decode($result);

//        echo '<pre>';
//        print_r($json);
//        echo '</pre>';

        if(isset($json->currently)){
            $weather = $json->currently;
            $weatherObject = array();
            $weatherObject['location'] = $json->timezone;
            $weatherObject['temp'] = round(($weather->temperature - 32) * 5/9);
            $weatherObject['weather_desc'] = $weather->summary;
            $weatherObject['pressure'] = $weather->pressure;
//            $weatherObject['wind_direction'] = $this->windDirection($weather->windDir);
            $weatherObject['wind_direction'] = '';
            $weatherObject['wind_speed'] = $weather->windSpeed * 1.61;

            return $weatherObject;
        }

        return null;
    }

    function windDirection($degrees){
        if(($degrees>0 && $degrees<=11) || ($degrees>349))
            return "N";
        elseif($degrees>11 && $degrees<=34)
            return "NNE";
        elseif($degrees>34 && $degrees<=56)
            return "NE";
        elseif($degrees>56 && $degrees<=79)
            return "ENE";
        elseif($degrees>80 && $degrees<=101)
            return "E";
        elseif($degrees>101 && $degrees<=124)
            return "ESE";
        elseif($degrees>124 && $degrees<=146)
            return "SE";
        elseif($degrees>146 && $degrees<=169)
            return "SSE";
        elseif($degrees>169 && $degrees<=191)
            return "S";
        elseif($degrees>191 && $degrees<=214)
            return "SSW";
        elseif($degrees>214 && $degrees<=236)
            return "SW";
        elseif($degrees>236 && $degrees<=259)
            return "WSW";
        elseif($degrees>259 && $degrees<=281)
            return "W";
        elseif($degrees>281 && $degrees<=304)
            return "WNW";
        elseif($degrees>304 && $degrees<=326)
            return "NW";
        elseif($degrees>326 && $degrees<=349)
            return "NNW";

        return "none";
    }
}