<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

// Wendy Thach, Cse451, Todoist assignment
// Controller for Todoist routes

class TodoistController extends Controller
{
	public function getTodoist(Request $request) {
		try {
			$CLIENT_ID = env('TODOIST_CLIENT_ID', '');
			$CLIENT_SECRET = env('TODOIST_CLIENT_SECRET', '');
			$client = new Client(['base_uri'=> 'https://todoist.com/oauth/access_token']);
			$response = $client->request('POST', '',[
				'query' => [
					'client_id' => $CLIENT_ID,
					'client_secret' => $CLIENT_SECRET,
					'code' => $request->query('code')]
			]);
			$body = json_decode($response->getBody(), true);
			$accessToken = $body['access_token'];
			$token_type = $body['token_type'];
			session(['token' => $accessToken]);
			session(['tokenType' => $token_type]);
			return redirect("/");
		} catch (ClientException $e) {
			print "Error authorizing from Todoist<br>";
			$response = $e->getResponse();
			$responseBodyAsString = $response->getBody()->getContents();
			print_r($responseBodyAsString);
			$error = print_r($responseBodyAsString, true);
			error_log($error);
			exit;
		}
	}

	public function getTask(Request $request, String $id) {
		if(session('token') == "") {
			$CLIENT_ID = env('TODOIST_CLIENT_ID', '');
			$STATE = env('TODOIST_STATE', '');
			return redirect("https://todoist.com/oauth/authorize?client_id=".$CLIENT_ID."&scope=data:read&state=".$STATE);
		} else {
			try {
				$client = new Client(['base_uri'=> 'https://api.todoist.com/rest/v2/tasks']);
				$str = '?project_id='.$id;
				$response = $client->request('GET', $str, [
					'headers' => ['Authorization' => session('tokenType').' '.session('token')]
				]);
				$body['body'] = json_decode($response->getBody());
				return view("task", $body);
			} catch (ClientException $e) {
				print "Error getting tasks from Todoist<br>";
				$response = $e->getResponse();
				$responseBodyAsString = $response->getBody()->getContents();
				print_r($responseBodyAsString);
				$error = print_r($responseBodyAsString, true);
				error_log($error);
				exit;
			}
		}
	}

	public function getToken(Request $request) {
		if(session('token') == "") {
			$CLIENT_ID = env('TODOIST_CLIENT_ID', '');
                        $STATE = env('TODOIST_STATE', '');
			return redirect("https://todoist.com/oauth/authorize?client_id=".$CLIENT_ID."&scope=data:read&state=".$STATE);
		} else {
			try {
				$client = new Client(['base_uri'=> 'https://api.todoist.com/rest/v2/']);
				$response = $client->request('GET', 'projects', [
					'headers' => ['Authorization' => session('tokenType').' '.session('token')]
				]);
				$body['body'] = json_decode($response->getBody());
				if(!$body) {
					error_log("No json given");
					exit;
				} else {
					return view("welcome", $body);
				}
			} catch (ClientException $e) {
				print "Error getting projects from Todoist<br>";
				$response = $e->getResponse();
				$responseBodyAsString = $response->getBody()->getContents();
				print_r($responseBodyAsString);
				$error = print_r($responseBodyAsString, true);
				error_log($error);
				exit;
			}
		}
	}
}

