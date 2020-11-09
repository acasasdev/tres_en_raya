<?php

namespace App\Http\Controllers;
use App\Models\GameBoardPosition;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class GameBoardPositionController extends Controller
{

    public function saveGameState(Request $request)
    {
        $gameBoardPosition = new GameBoardPosition;
        $gameBoardPosition->board = $request->board;
        $gameBoardPosition->player = $request->player;
        $gameBoardPosition->position = $request->position;
        $gameBoardPosition->save();

        $winner = self::checkGameState($gameBoardPosition->board);

        $response=['winner' => $winner];

        return response()->json($response);
    }

    private function checkGameState($board){

        $gameBoardPositions = GameBoardPosition::where('board', $board)->get()->toArray();

        $board = array(0 => -1, 1 => -1, 2 => -1, 3 => -1, 4 => -1, 5 => -1, 6 => -1, 7 => -1, 8 => -1);

        foreach ($gameBoardPositions as $key => $gameBoardPosition){
            $board[$gameBoardPosition['position']] = $gameBoardPosition['player'];
        }

        if($board[0] == $board[1] && $board[1] == $board[2] && $board[0]!= -1 && $board[1]!= -1 && $board[2]!= -1)
        {
            $response = $board[0];
        }
        else if($board[3] == $board[4] && $board[4] == $board[5] && $board[3]!= -1 && $board[4]!= -1 && $board[5]!= -1)
        {
            $response = $board[4];
        }
        else if($board[6] == $board[7] && $board[7] == $board[8] && $board[6]!= -1 && $board[7]!= -1 && $board[8]!= -1)
        {
            $response = $board[6];
        }
        else if($board[0] == $board[3] && $board[3] == $board[6] && $board[0]!= -1 && $board[3]!= -1 && $board[6]!= -1)
        {
            $response = $board[3];
        }
        else if($board[1] == $board[4] && $board[4] == $board[7] && $board[1]!= -1 && $board[4]!= -1 && $board[7]!= -1)
        {
            $response = $board[1];
        }
        else if($board[2] == $board[5] && $board[5] == $board[8] && $board[2]!= -1 && $board[5]!= -1 && $board[8]!= -1)
        {
            $response = $board[5];
        }
        else if($board[0] == $board[4] && $board[4] == $board[8] && $board[0]!= -1 && $board[4]!= -1 && $board[8]!= -1)
        {
            $response = $board[8];
        }
        else if($board[2] == $board[4] && $board[4] == $board[6] && $board[2]!= -1 && $board[4]!= -1 && $board[6]!= -1)
        {
            $response = $board[2];
        }
        else
        {
            if($board[0]!= -1 && $board[1]!= -1 && $board[2]!= -1 && $board[3]!= -1 && $board[4]!= -1 && $board[5]!= -1 && $board[6]!= -1 && $board[7]!= -1 && $board[8]!= -1)
            {
                $response = 2;
            }

            else{
                $response = -1;
            }
        }

        if($response != -1){
            $session = new Session();
            $session->clear();
        }

        return $response;
    }
}
