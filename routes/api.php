<?php

use App\Http\Controllers\Api\FloorController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\UserController;
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

Route::get("/", [UserController::class, 'index']);
Route::get("/users/{userid}", [UserController::class, 'show']);
Route::get("/users/delete/{userid}", [UserController::class, 'destroy']);
Route::post("/users", [UserController::class, 'store']);

// Floors
Route::post("/floors", [FloorController::class, 'store']);

// Rooms
Route::post("/rooms", [RoomController::class, 'store']);
Route::get("rooms", [RoomController::class, 'index']);
Route::get('/rooms/{room}', [RoomController::class, 'show']);
Route::put('rooms/{room}', [RoomController::class, 'update']);
Route::delete('rooms/{room}', [RoomController::class, 'destroy']);
