<?php

use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\FloorController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\UserController;
use App\Models\User;
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

Route::group(['middleware' => ['auth:sanctum']], function () {
    // Clients
    Route::post("/clients", [ClientController::class, 'store']);
    Route::get("clients", [ClientController::class, 'index']);
    Route::get('/clients/{client}', [ClientController::class, 'show']);
    Route::put('clients/{client}', [ClientController::class, 'update']);
    Route::delete('clients/{client}', [ClientController::class, 'destroy']);
});

//users
Route::post("/users", [UserController::class, 'store']);
Route::get("/users/restore/all", [UserController::class, 'retrieve']);
Route::post("/users/approve/{client}", [UserController::class, 'approve'])->name('approve.clients');
Route::post("/users/decline/{client}", [UserController::class, 'decline'])->name('decline.clients');
Route::get("/users/{userid}", [UserController::class, 'show']);
Route::put("/users/{userid}", [UserController::class, 'update']);
Route::delete("/users/{userid}", [UserController::class, 'destroy']);

// Floors
Route::post("/floors", [FloorController::class, 'store'])->name('floors.store');
Route::get('/floors/{floor}', [FloorController::class, 'show']);
Route::put('floors/{floor}', [FloorController::class, 'update'])->name('floors.update');
Route::delete('floors/{floor}/delete', [FloorController::class, 'destroy']);

// Rooms
Route::post("/rooms", [RoomController::class, 'store'])->name('rooms.store');
Route::get("rooms", [RoomController::class, 'index']);
Route::get('/rooms/{room}', [RoomController::class, 'show']);
Route::put('rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');
Route::delete('rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');

// Reservations
Route::post("/reservations", [ReservationController::class, 'store']);
Route::get("reservations", [ReservationController::class, 'index']);
Route::get('/reservations/{reservation}', [ReservationController::class, 'show']);
Route::put('reservations/{reservation}', [ReservationController::class, 'update']);
Route::delete('reservations/{reservation}', [ReservationController::class, 'destroy']);

Route::get("floors", [FloorController::class, 'index']);
Route::get('clients/{client}/reservations', [ClientController::class, 'show_client_reservations']);

Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    return $user->createToken($request->device_name)->plainTextToken;
});

Route::get("/users", [UserController::class, 'index']);
