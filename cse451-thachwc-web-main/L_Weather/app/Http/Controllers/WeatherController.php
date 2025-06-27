<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

// Wendy Thach, CSE451, L_Weather Assignment

class WeatherController extends Controller
{
	public function getTemp(Request $request, String $zipcode) {
		$xauth = $request->header('X-AUTH');
		$ip = $request->ip();
		date_default_timezone_set('America/New_York');
		$time = date('H:i:s');
		if (!Cache::has("token") || $xauth == "") {
			$response = array (
				"message"=> "Access Denied ".$time,
				"status"=>"FAIL"
			);
			return response()->json($response, 401);
		}
		else if (Cache::get('token') != $xauth) {
			$response = array (
				"message"=> "Token is invalid ".$time,
				"status"=>"FAIL"
			);
			return response()->json($response, 401);
		}
		else if (Cache::get('tokenCount') > 4) {

			Cache::flush();
			$response = array (
				"message"=> "Authorization limit exceeded ".$time,
				"status"=>"FAIL"
			);
			return response()->json($response, 400);
		}
		else {
			Cache::forever('tokenCount', Cache::get('tokenCount')+1);
		if (Cache::has($zipcode)) {
			$data = Cache::get($zipcode);
			$data = array_replace($data, array("status" => "CACHE"));
			return response()->json($data);
		} else {
			try {
				$APIKEY = env('VISUAL_CROSSING_API_KEY','');
				if ($APIKEY == "") {
					die ("API KEY NOT DEFINED");
				}
				$client = new Client(['base_uri' => 'https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/']);
				$str = $zipcode.'?key='.$APIKEY;
				$response = $client->request('GET', $str);
				$body = json_decode($response->getBody());
				$array = array (
					"today"=>$body->{'days'}[0],
					"tomorrow"=>$body->{'days'}[1],
					"status" => "LIVE"
				);
				Cache::put($zipcode,$array,$seconds=15);
				return response()->json($array);
			}
			catch (ClientException $e) {
				$response = $e->getResponse();
				$responseBodyAsString = $response->getBody()->getContents();
				$return = array (
					"message" => $responseBodyAsString." ".$time,
					"status" => "FAIL"
				);
				return response()->json($return, 400);
			}
		}
		}
	}
	public function getToken(Request $request) {
		$token = randString(50);
		if (Cache::has("token")) {
			return Cache::get("token");
		}
		else
		{
			Cache::forever("token", $token);
			Cache::forever("tokenCount", 0);
			return $token;
		}
	}
}
function randString($length = 10) {
	$chara = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charaLength = strlen($chara);
	$tok = '';
	for ($i = 0; $i < $length; $i++) {
		$tok .= $chara[rand(0, $charaLength - 1)];
	}
	return $tok;
}
