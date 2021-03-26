<?php

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

Route::post("/rooms", [RoomController::class, 'store']);
// Route::post("/rooms", function (Request $request) {
//     dd($request);
// });
