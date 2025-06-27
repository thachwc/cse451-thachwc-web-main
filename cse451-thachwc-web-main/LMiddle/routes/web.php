<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\SessionController;
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
	return view('welcome');
})->middleware('trackRoute');

Route::get('/hello', function (Request $request) {
	return view('hello');
})->middleware('trackRoute');

Route::get('/random', function(Request $request) {
	$data=[];
	for($i = 0; $i < 25; $i++) {
		$data[$i] = rand();
	}
	return view('random', ['a' => $data]);
})->middleware('trackRoute');

Route::get('/session', function(Request $request) {
	$pageCount = $request->session()->get('pageCount', 0);
        $sessionCount = $request->session()->get('sessionCount', 0);
	return view('session', ['pageCount' => $pageCount, 'sessionCount' => $sessionCount]);
})->middleware('trackRoute');

Route::get('/log', [SessionController::class, 'log'])->middleware('trackRoute');
