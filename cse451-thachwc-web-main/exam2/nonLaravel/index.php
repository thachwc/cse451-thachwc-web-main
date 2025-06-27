<?php
require_once "vendor/autoload.php";
use GuzzleHttp\Client;


$zipCode = $argv[1];
require("./passwd.php");
$client = new GuzzleHttp\Client(['base_uri' => 'https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/']);
$route = $zipCode."?key=".$apiKey;

$response = $client->request('GET', $route);

$data = json_decode($response->getBody(), true);
echo json_encode(array(
	"date" => $data["days"][0]["datetime"],
	"temp" => $data["days"][0]["temp"],
	"tempmin" => $data["days"][0]["tempmin"],
	"tempmax" => $data["days"][0]["tempmax"],
	"conditions" => $data["days"][0]["conditions"],
	"humidity"=> $data["days"][0]["humidity"]),
	JSON_PRETTY_PRINT
	);
?>
