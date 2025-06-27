<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Cache;

// Wendy Thach cse451 final project

class WeatherController extends Controller
{
	public function getWeather(Request $request) {
		$tokenFromHeader = $request->header('X-AUTH-FINAL-TOKEN');
		$zipCode = session('zipcode', '45056');
		if ($tokenFromHeader == Cache::get('token') && Cache::has('token')) {
			if (Cache::has('weather') && Cache::get('weather')["message"]["weather"]["address"] == $zipCode) {
				return response()->json(Cache::get('weather'), 201);
			}
			else {
				try {
					$APIKEY = env('VISUAL_CROSSING_API_KEY','');
					if ($APIKEY == "") {
						die ("API KEY NOT DEFINED");
					}
					$client = new Client(['base_uri' => 'https://w3ir0op2nj.execute-api.us-east-1.amazonaws.com/prod/']);
					$str = "weather"."?zipcode=".$zipCode."&key=".$APIKEY;
					$response = $client->request('GET', $str, [
						'headers' => ['X-AUTH-FINAL-TOKEN' => $tokenFromHeader]
					]);
					$body = json_decode($response->getBody(), true);

					if (array_key_exists('weather', $body["message"])){
						Cache::put('weather', $body, 30);
					}
					return response()->json($body, 200);
				} catch (ClientException  $e) {
					$response = $e->getResponse();
					$responseBodyAsString = $response->getBody()->getContents();
					$return = array (
						"response" => $responseBodyAsString,
						"status" => "fail"
					);
					return response()->json($return, 400);
				}
			}
		}
		else {
			$return = array (
				"message" => "Invalid header token"
			);
			return response()->json($return, 400);
		}
	}
}
