<?php

namespace App\Http\Controllers;
use App\Models\GameBoard;
use App\Models\GameBoardPosition;
use Symfony\Component\HttpFoundation\Session\Session;

class GameBoardController extends Controller
{
    public function create()
    {
        $session = new Session();
        $lastBoard = $session->get('board');
        $gameBoardLastState = [];

        if($lastBoard){
            $gameBoardLastState = GameBoardPosition::getLastBoard($lastBoard);
        }else{
            $gameBoard = new GameBoard;
            $gameBoard->save();
            $session->set('board', $gameBoard->id);
            $session->save();
        }

        return response()->json(['gameBoardId' => $session->get('board'), 'gameBoardLastState' => $gameBoardLastState]);
    }
}
