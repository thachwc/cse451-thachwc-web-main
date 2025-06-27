<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
	$user = session('user', "");
	session(['user' => $user]);
	$data['user'] = $user;
	return view('welcome', $data);
});

Route::get('/data', function () {
	$array['data'] = json_decode(DB::table('log')->get(), true);
	$array['user'] = request()->user;
	session(['user'=>request()->user]);
	return view('data', $array);
});

Route::get('/edit', function () {
	$id = request()->id;
	$cnt = DB::table('log')->where('id', $id);
	$data['data'] = json_decode($cnt->get(), true);
	return view('edit', $data);
});
Route::post('/update', function(Request $request) {
	$comment = $request->input('comment', '');
	$id = $request->input('id',0);
	if ($comment != "" && $id != 0) {
		DB::table('log')->where('id', $id)->update(['comments'=> $comment]);
	}
	$data['data'] = json_decode(DB::table('log')->get(), true);
	$str = "data?user=".session('user','');
	return redirect()->to($str);
});
