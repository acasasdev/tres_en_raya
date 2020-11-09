<?php

namespace App\Http\Controllers;
use App\Models\GameBoardPosition;
use Illuminate\Http\Request;

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

    /*private function checkGameState($board){

        $gameBoardPositions = GameBoardPosition::where('board', $board)->get()->toArray();

        $board = array(0,1,2,3,4,5,6,7,8);

        foreach ($gameBoardPositions as $key => $gameBoardPosition){
            $board[$key+1] = $gameBoardPosition['player'];
        }

        $winLines = [
            [[1, 2], [4, 8], [3, 6]],
            [[0, 2], [4, 7]],
            [[0, 1], [4, 6], [5, 8]],
            [[4, 5], [0, 6]],
            [[3, 5], [0, 8], [2, 6], [1, 7]],
            [[3, 4], [2, 8]],
            [[7, 8], [2, 4], [0, 3]],
            [[6, 8], [1, 4]],
            [[6, 7], [0, 4], [2, 5]]
        ];

        $playerPosition = $gameBoardPositions[(sizeof($gameBoardPositions) - 1)];
        $lastMove = $playerPosition['position'];
        $player = $board[$lastMove];

        for ($i = 0; $i < sizeof($winLines[$lastMove]); $i++) {
            $line = $winLines[$lastMove][$i];
            if($player === $board[$line[0]] && $player === $board[$line[1]]) {
                return true;
            }
        }

        return false;

    }*/

    private function checkGameState($board){

        $gameBoardPositions = GameBoardPosition::where('board', $board)->get()->toArray();

        $board = array(0 => -1, 1 => -1, 2 => -1, 3 => -1, 4 => -1, 5 => -1, 6 => -1, 7 => -1, 8 => -1);

        foreach ($gameBoardPositions as $key => $gameBoardPosition){
            $board[$gameBoardPosition['position']] = $gameBoardPosition['player'];
        }

        if($board[0] == $board[1] && $board[1] == $board[2] && $board[0]!= -1 && $board[1]!= -1 && $board[2]!= -1)
        {
           return $board[0];
        }
        else if($board[3] == $board[4] && $board[4] == $board[5] && $board[3]!= -1 && $board[4]!= -1 && $board[5]!= -1)
        {
           return $board[4];
        }
        else if($board[6] == $board[7] && $board[7] == $board[8] && $board[6]!= -1 && $board[7]!= -1 && $board[8]!= -1)
        {
           return $board[6];
        }
        else if($board[0] == $board[3] && $board[3] == $board[6] && $board[0]!= -1 && $board[3]!= -1 && $board[6]!= -1)
        {
           return $board[3];
        }
        else if($board[1] == $board[4] && $board[4] == $board[7] && $board[1]!= -1 && $board[4]!= -1 && $board[7]!= -1)
        {
           return $board[1];
        }
        else if($board[2] == $board[5] && $board[5] == $board[8] && $board[2]!= -1 && $board[5]!= -1 && $board[8]!= -1)
        {
           return $board[5];
        }
        else if($board[0] == $board[4] && $board[4] == $board[8] && $board[0]!= -1 && $board[4]!= -1 && $board[8]!= -1)
        {
           return $board[8];
        }
        else if($board[2] == $board[4] && $board[4] == $board[6] && $board[2]!= -1 && $board[4]!= -1 && $board[6]!= -1)
        {
           return $board[2];
        }
        else
        {
            if($board[0]!= -1 && $board[1]!= -1 && $board[2]!= -1 && $board[3]!= -1 && $board[4]!= -1 && $board[5]!= -1 && $board[6]!= -1 && $board[7]!= -1 && $board[8]!= -1)
            {
                return 2;
            }

            else{
                return -1;
            }
        }

    }
}
