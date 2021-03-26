<?php

use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\FloorController;
use App\Http\Controllers\Api\ReservationController;
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

//users
Route::post("/users", [UserController::class, 'store']);
Route::get("/users", [UserController::class, 'index']);
Route::get("/users/{userid}", [UserController::class, 'show']);
Route::put("/users/{userid}", [UserController::class, 'update']);
Route::delete("/users/delete/{userid}", [UserController::class, 'destroy']);

// Floors
Route::post("/floors", [FloorController::class, 'store']);
Route::get("floors", [FloorController::class, 'index']);
Route::get('/floors/{floor}', [FloorController::class, 'show']);
Route::put('floors/{floor}', [FloorController::class, 'update']);
Route::delete('floors/{floor}', [FloorController::class, 'destroy']);

// Rooms
Route::post("/rooms", [RoomController::class, 'store']);
Route::get("rooms", [RoomController::class, 'index']);
Route::get('/rooms/{room}', [RoomController::class, 'show']);
Route::put('rooms/{room}', [RoomController::class, 'update']);
Route::delete('rooms/{room}', [RoomController::class, 'destroy']);

// Reservations
Route::post("/reservations", [ReservationController::class, 'store']);
Route::get("reservations", [ReservationController::class, 'index']);
Route::get('/reservations/{reservation}', [ReservationController::class, 'show']);
Route::put('reservations/{reservation}', [ReservationController::class, 'update']);
Route::delete('reservations/{reservation}', [ReservationController::class, 'destroy']);

//Clients
Route::post("/clients", [ClientController::class, 'store']);
Route::get("clients", [ClientController::class, 'index']);
Route::get('/clients/{client}', [ClientController::class, 'show']);
Route::put('clients/{client}', [ClientController::class, 'update']);
Route::delete('clients/{client}', [ClientController::class, 'destroy']);
