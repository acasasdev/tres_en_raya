<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameBoardPosition extends Model
{
    use HasFactory;

    public static function getLastBoard($board)
    {
        return GameBoardPosition::where('board', $board)->get()->toArray();
    }
}
