<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class TempController extends Controller
{
	public function temp() {
		$temp = DB::connection('mysql1')->select('select distinct from_unixtime(sampleTime,"%Y-%m-%d") as date from temp order by date');
		return response()->json(['dates'=>$temp]);
	}

	public function tempDate(String $n) {
		$temp = DB::connection('mysql1')->select('select from_unixtime(sampleTime) as date,outputTemp,roomTemp from temp where from_unixtime(sampleTime,"%Y-%m-%d-%H") = :date',['date'=>$n]);
		return response()->json(['temp'=>$temp]);
	}

	public function tempAverageDate(String $n) {
		$temp = DB::connection('mysql1')->select('select CONVERT(AVG(outputTemp), char) as averageOutput, CONVERT(AVG(roomTemp), char) as averageRoom from temp where from_unixtime(sampleTime,"%Y-%m-%d-%H") = :date',['date'=>$n]);
		return response()->json($temp);
	}
}
