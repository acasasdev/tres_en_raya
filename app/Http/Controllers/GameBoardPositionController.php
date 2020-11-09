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
    }
}
