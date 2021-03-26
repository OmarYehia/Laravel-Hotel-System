<?php

use App\Http\Controllers\Api\RoomController;
use App\Http\Requests\StoreRoomRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/rooms", [RoomController::class, 'store']);
 /*Route::post("/rooms", function (StoreRoomRequest $request) {
     dd($request);
 });*/
