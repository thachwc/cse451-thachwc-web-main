<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
| Wendy Thach, cse451, L_Weather assignment
|
 */
Route::middleware(['cas.auth'])->group(function() {

Route::get('/', function () {
	$user = session('user', "");
	session(['user' => $user]);
	$data['user'] = $user;
    	return view('welcome', $data);
});
Route::get('/weather', function() {
	$array['user'] = request()->user;
	session(['user'=>request()->user]);
	return view('weather', $array);
});
});
