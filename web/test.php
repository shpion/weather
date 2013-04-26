<?php
//header("User-Agent:Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:18.0) Gecko/20100101 Firefox/18.0");

$url = "https://api.forecast.io/forecast/7b6da4e5ca4ef6e649e40cef4f88d2ac/37.8267,-122.423";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_USERAGENT, "	Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0");
$result = curl_exec($curl);

$json = json_decode($result);

echo '<pre>';
print_r($json);
echo '</pre>';