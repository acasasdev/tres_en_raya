<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameBoardController;
use App\Http\Controllers\GameBoardPositionController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware' => 'web'], function () {

    Route::get('/getPlayer/{player}', function ($player) {
        return $player == 0 ? 1 : 0;
    });

    Route::get('/createBoard', [GameBoardController::class, 'create']);

    Route::post('/saveGameState', [GameBoardPositionController::class, 'saveGameState']);
});
