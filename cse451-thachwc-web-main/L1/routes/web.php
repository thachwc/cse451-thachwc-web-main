<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
| Wendy Thach
| CSE451
*/

Route::get('/', function (Request $request) {
	$sessionCount = $request->session()->get('sessionCount', 0);
	$sessionCount++;
	$request->session()->put('sessionCount', $sessionCount);
	return view('welcome');
});

Route::get('/hello', function (Request $request) {
	$sessionCount = $request->session()->get('sessionCount', 0);
        $sessionCount++;
        $request->session()->put('sessionCount', $sessionCount);
	return view('hello');
});

Route::get('/random', function(Request $request) {
	$sessionCount = $request->session()->get('sessionCount', 0);
        $sessionCount++;
	$request->session()->put('sessionCount', $sessionCount);
	$data=[];
	for($i = 0; $i < 25; $i++) {
		$data[$i] = rand();
	}
	return view('random', ['a' => $data]);
});

Route::get('/session', function(Request $request) {
	$pageCount = $request->session()->get('pageCount', 0);
        $pageCount++;
        $request->session()->put('pageCount', $pageCount);

	$sessionCount = $request->session()->get('sessionCount', 0);
        $sessionCount++;
        $request->session()->put('sessionCount', $sessionCount);
	
	return view('session', ['pageCount' => $pageCount, 'sessionCount' => $sessionCount]);
});
