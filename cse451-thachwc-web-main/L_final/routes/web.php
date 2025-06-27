<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\NumberController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WeatherController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
| Wendy Thach Cse451 Final project
*/
Route::middleware(['cas.auth'])->group(function() {

Route::get('/', function () {
	$data["zipcode"] = session('zipcode');
	$data["uniqueID"] = cas()->user();
	return view('welcome', $data);
});
Route::get('/profile', function () {
	$data["error"] = session('error', '');
	$data["uniqueID"] = cas()->user();
	return view('profile', $data);
});
Route::get('/getWeather', [WeatherController::class,'getWeather'])->name('getWeather');
Route::post('/postzipcode', function (Request $request) {
	$zipCode = $request->input('zipcode', '');
	if (preg_match("/[a-zA-Z]/i", $zipCode)) {
		session(['error' => 'Invalid zipcode']);
		return redirect()->to('profile');
	}
	else {
		session(['error' => '']);
		session(['zipcode' => $request->input('zipcode', '')]);
		return redirect()->to('/');
	}
});
Route::get('/numbers', function () {
	if (session('numberError', '') != '') {
		$data["info"] = session('numberError');
		$data["uniqueID"] = cas()->user();
		return view('numbers', $data);
	}
	else {
		$data["info"] = session('numberInfo',  '');
		$data["uniqueID"] = cas()->user();
		return view('numbers', $data);
	}
});
Route::get("/numberinfo", [NumberController::class,'getNumber'])->middleware(\App\Http\Middleware\Handle::class);
Route::get('/authors', function () {
	$data["uniqueID"] = cas()->user();
	return view('authors', $data);
});
Route::get('/auth', function () {
	$data["uniqueID"] = cas()->user();
        return view('auth', $data);
});
Route::get('/generateToken', [AuthController::class,'generateToken'])->name('generateToken');
Route::get('/getToken', [AuthController::class,'getToken'])->name('getToken');
Route::get('/api', function () {
	$data["uniqueID"] = cas()->user();
        return view('api', $data);
});
});
