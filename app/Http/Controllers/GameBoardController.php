<?php

namespace App\Http\Controllers;
use App\Models\GameBoard;
use Illuminate\Http\Request;

class GameBoardController extends Controller
{
    public function create()
    {
        $gameBoard = new GameBoard;
        $gameBoard->save();
        return $gameBoard;
    }
}
