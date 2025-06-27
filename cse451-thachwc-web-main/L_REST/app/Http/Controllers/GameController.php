<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    public function index()
    {
	    $board = DB::select("select id, name from game");
            return response()->json($board);
    }

    public function createGameboard(Request $request)
    {
	    $gameBoardName = $request->input('gameBoardName','');
	    if (empty($gameBoardName))
		    return response('invalid request','');
	    $board = DB::select("select id from game where name=:name", ['name'=>$gameBoardName]);
	    if(count($board) != 0)
		    return response('GameBoardName exist', 400);
	    DB::insert("insert into game (name) values(:name)",['name'=>$gameBoardName]);
	    $g = DB::select("select id from game where name=:name", ['name'=>$gameBoardName]);
	    return response()->json($g[0]);

    }

    public function getGameboard(Request $request, String $id)
    {
	    if(!is_numeric($id) || empty($id))
		    return response("Invalid id", 400);
	    $game = DB::select("select * from game where id=:id",['id'=>$id]);
	    if(!isset($game[0]))
		    return response('Requested game does not exist',400);
	    return response()->json($game[0]);
    }

    public function updateCell(Request $request, String $id, String $position)
    {
	    $pieceName = $request->input('pieceName','');
	    if ($pieceName == '')
		    return response('invalid piece name',400);
	    if (!is_numeric($position) || $position<0 || $position >9)
		    return response('invalid position',400);
	    $pName = "c".htmlspecialchars($position);
	    //see if it exists
	    $g = DB::select("select id, $pName as position from game where id=:id",['id'=>$id]);
	    if (count($g) != 1)
		    return response('invalid board id',400);
	    if ($g[0]->position != "")
	    {
		    return response('position taken',400);
	    }
	    DB::table('game')->where('id',$id) -> update([$pName=>$pieceName]);
	    return response()->json();
    }

    public function clearBoard(String $id)
    {
	    if (empty($id) || !is_numeric($id))
		    return response("bad input", 400);
	    $game = DB::select("select id from game where id=:id",['id'=>$id]);
	    if(count($game) != 1)
		    return response('Board does not exist',400);
	    DB::table('game')->where('id',$id)->delete();
	    return response()->json();
    }
}
