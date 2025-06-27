<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
	public function log(Request $request){
		$title = "Page Cnt<br>";
		$welcome = "/&emsp;".$request->session()->get('welcomeCount', 0);
		$hello = "<br>/hello&emsp;".$request->session()->get('helloCount', 0);
		$random = "<br>/random&emsp;".$request->session()->get('randomCount', 0);
		$sess = "<br>/session&emsp;".$request->session()->get('pageCount', 0);
		$array = array($title, $welcome, $hello, $random, $sess);
		foreach($array as $s) {
			print $s;
		}
	}
}
