<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TempController;
use App\Http\Controllers\GameController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
| Wendy Thach, CSE451, Laravel Rest1 HW
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/temp', [TempController::class, 'temp']);

Route::get('/temp/{date}', [TempController::class, 'tempDate']);

Route::get('/temp/average/{date}', [TempController::class, 'tempAverageDate']);

Route::get('/game', [GameController::class, 'index']);

Route::put('/game', [GameController::class, 'createGameboard']);

Route::get('/game/{boardID}', [GameController::class, 'getGameboard']);

Route::post('/game/{boardID}/{position}', [GameController::class, 'updateCell']);

Route::delete('/game/{boardID}', [GameController::class, 'clearBoard']);
