<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

// Wendy Thach, CSE451, Final Project

class NumberController extends Controller
{
	public function getNumber(Request $request) {
		$tokenFromHeader = $request->header('X-AUTH-FINAL-TOKEN');
		$num = $request->input('num');
		if ($tokenFromHeader == Cache::get('token') && Cache::has('token') && $num != '') {
			try {
				$client = new Client(['base_uri' => 'http://numbersapi.com/']);
				$response = $client->request('GET', $num);
				session(['numberInfo' => $response->getBody()->getContents()]);
				session(['numberError' => '']);
				return redirect()->to('numbers');
			} catch (ClientException $e) {
				$response = $e->getResponse();
				$responseBodyAsString = $response->getBody()->getContents();
				$return = array (
					"message" => $responseBodyAsString
				);
				session(['numberError' => 'Error not a number, please enter in a number']);
				session(['numberInfo' => '']);
				return redirect()->to('numbers');
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
