<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
| Wendy Thach, Cse451, L_Weather Assignment
|
*/
Route::get("/weather/{zipcode}",[WeatherController::class,'getTemp']);
Route::get("/token", [WeatherController::class,'getToken']);
