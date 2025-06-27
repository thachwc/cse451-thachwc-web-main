<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

// Wendy Thach cse451 final project

class AuthorController extends Controller
{
	public function getAuthor(Request $request, String $author) {
		$tokenFromHeader = $request->header('X-AUTH-FINAL-TOKEN');
		if ($tokenFromHeader == Cache::get('token') && Cache::has('token')) {
			try {
				$client = new Client(['base_uri' => 'https://openlibrary.org/search/authors.json']);
				$str = "?q=".$author;
				$response = $client->request('GET', $str);
				$body = json_decode($response->getBody());
				$array = array (
					"docs" => $body->{'docs'}
				);
				return response()->json($array);
			} catch (ClientException $e) {
				$response = $e->getResponse();
				$responseBodyAsString = $response->getBody()->getContents();
				$return = array (
					"message" => $responseBodyAsString
				);
				return response()->json($return, 400);
			}
		}
		else {
			$return = array (
				"message" => "Invalid header token".$tokenFromHeader.":".Cache::get('token')
			);
			return response()->json($return, 400);
		}
	}
}
