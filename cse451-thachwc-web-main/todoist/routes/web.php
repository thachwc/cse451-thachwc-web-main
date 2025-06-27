<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoistController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
| Wendy Thach, Todoist assignment for cse451
|
*/

Route::get('/', [TodoistController::class,'getToken']);

Route::get('/todoistcode', [TodoistController::class,'getTodoist']);

Route::get('/task/{id}', [TodoistController::class,'getTask']);
