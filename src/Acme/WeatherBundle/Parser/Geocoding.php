<?php

namespace Acme\WeatherBundle\Parser;

class Geocoding
{
    public function findGeodata($city){

        $address = urlencode($city);
        $url = "http://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $r = curl_exec($curl);
        $result = json_decode($r);

        $address = array();
        if(isset($result)){
            foreach($result->results[0]->address_components as $component){
                if($component->types[0] == "locality")
                    $address['city'] = $component->short_name;
                elseif($component->types[0] == "country")
                    $address['country'] = $component->short_name;
            }
            $address['lat'] = $result->results[0]->geometry->location->lat;
            $address['lng'] = $result->results[0]->geometry->location->lng;
        }

        return $address;
    }
}