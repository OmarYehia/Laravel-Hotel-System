<?php

use App\Http\Controllers\Api\FloorController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\GoogleClientController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\AvailableRoomAjaxController;
use App\Http\Controllers\ManagerAjaxController;
use App\Http\Controllers\managingController;
use App\Http\Controllers\ReceptionistAjaxController;
use App\Http\Controllers\StaffLogoutController;
use App\Http\Controllers\StaffRegisterController;
use Illuminate\Support\Facades\Route;

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
    if (Auth::guard('client')->check()) {
        return view('client-views.reservations');
    } elseif (Auth::guard('user')->check()) {
        return route('admin.home');
    }
})->name('index')->middleware('auth:client');

Route::get('/register', [RegisterController::class,'index'])->name('register');
Route::post('/register', [RegisterController::class,'store'])->name('register');

Route::get('/login/client', [LoginController::class,'showClientLoginForm'])->name('login.client');
Route::post('/login/client', [LoginController::class,'clientLogin'])->name('login.client');

Route::get('/login/admin', [LoginController::class,'showAdminLoginForm'])->name('login.admin');
Route::post('/login/admin', [LoginController::class,'adminLogin'])->name('login.admin');

Route::get('/auth/google/redirect', [GoogleClientController::class, 'redirectToProvider']);
Route::get('/auth/google/callback', [GoogleClientController::class, 'handleProviderCallback']);

Route::get('/logout/client', [LogoutController::class,'logout'])->name('logout.client');
Route::get('/logout', [StaffLogoutController::class, 'logout'])->name('logout');
// Route::get('/home', [FloorController::class,'index'])->name('index');

Route::get('/forget-password', [ForgotPasswordController::class,'getEmail'])->name('forget-password');
Route::post('/forget-password', [ForgotPasswordController::class,'postEmail'])->name('forget-password');

Route::get('/reset-password/{token}', [ResetPasswordController::class,'getPassword'])->name('reset-password');
Route::post('/reset-password', [ResetPasswordController::class,'updatePassword'])->name('reset-password');

// Admin routes
Route::get('/admin', function () {
    return view('admin-views.home');
})->name('admin.home')->middleware('auth:user');

Route::get('/admin/register', [StaffRegisterController::class, 'index'])->name('admin.index')->middleware('auth:user');
Route::post('/admin/register', [StaffRegisterController::class, 'store'])->name('admin.store')->middleware('auth:user');



Route::get('/manage-floors', [managingController::class, 'floors'])->name('manage.floors');
Route::get('/manage-rooms', [managingController::class, 'rooms'])->name('manage.rooms');


Route::get('/logout', [StaffLogoutController::class, 'logout'])->name('logout');


Route::get('/available-rooms', [AvailableRoomAjaxController::class, 'index'])->name('ajaxavailablerooms.index');
// Manager Routes
Route::get('/managers', [ManagerAjaxController::class, 'index'])->name('managers.index');

// Receptionists Routes
Route::get('/receptionists', [ReceptionistAjaxController::class, 'index'])->name('receptionists.index');
Route::get('/logout', [StaffLogoutController::class, 'logout'])->name('logout');
