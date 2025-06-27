<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Cache;
use Memcached;

// Wendy Thach cse451 Final Project

class AuthController extends Controller
{
	public function generateToken() {
		if (Cache::has("token")) {
			return response()->json("", 400);
		}
		else {
			try {
				$generatedToken = randString(40);
				Cache::put("token", $generatedToken, 60);

				session("token", $generatedToken);
				$secret = env('SECRET_KEY','');
				if ($secret == "") {
					die ("SECRET KEY NOT DEFINED");
				}
				$client = new Client(['base_uri' => 'https://w3ir0op2nj.execute-api.us-east-1.amazonaws.com/prod/']);
				$response = $client->request('GET', "token?key=".$generatedToken, [
					'headers' => ['SECRET' => $secret]
				]);
			} catch (ClientException $e) {
				$response = $e->getResponse();
				$responseBodyAsString = $response->getBody()->getContents();
				$return = array (
					"message" => $responseBodyAsString
				);
				return response()->json($return, 400);
			}
			return response()->json("", 200);
		}
	}

	public function getToken() {
		if (Cache::has("token")) {
			$return = array (
				"token" => Cache::get("token")
			);
			return response()->json($return, 200);
		}
		else {
			$return = array (
				"token" => ""
			);
			return response()->json($return, 200);
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
