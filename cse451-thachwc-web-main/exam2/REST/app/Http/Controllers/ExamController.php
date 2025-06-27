<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
	public function exam() {
		$g = DB::connection('mysql')->select('select name from e');
		return response()->json($g);
	}
}
