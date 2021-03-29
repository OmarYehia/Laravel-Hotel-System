<?php

use App\Http\Controllers\Auth\LoginController;
use  App\Http\Controllers\Auth\LogoutController;
use  App\Http\Controllers\Auth\RegisterController;
use  Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/register', [RegisterController::class,'index'])->name('register');
Route::post('/register', [RegisterController::class,'store'])->name('register');

Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class,'store'])->name('login');

Route::get('/logout', [LogoutController::class,'logout'])->name('logout');

Route::get('/home', function () {
    return view('client-views.reservations');
});