<?php

use App\Http\Controllers\Api\ClientController;
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
use App\Http\Controllers\StripeController;
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

// General routes
Route::get('/', function () {
    if (Auth::guard('client')->check()) {
        return redirect()->route('client-home');
    } elseif (Auth::guard('user')->check()) {
        return route('admin.home');
    }
})->name('index')->middleware('auth:client');

Route::get('/home', function () {
    return view('client-views.home');
})->name('client-home');


// All client routes
// Login and Logout
Route::get('/register', [RegisterController::class,'index'])->name('register');
Route::post('/register', [RegisterController::class,'store'])->name('register');
Route::get('/login/client', [LoginController::class,'showClientLoginForm'])->name('login.client');
Route::post('/login/client', [LoginController::class,'clientLogin'])->name('login.client');
Route::get('/auth/google/redirect', [GoogleClientController::class, 'redirectToProvider']);
Route::get('/auth/google/callback', [GoogleClientController::class, 'handleProviderCallback']);
Route::get('/logout/client', [LogoutController::class,'logout'])->name('logout.client');
Route::get('/logout', [StaffLogoutController::class, 'logout'])->name('logout');
// Resetting password
Route::get('/forget-password', [ForgotPasswordController::class,'getEmail'])->name('forget-password');
Route::post('/forget-password', [ForgotPasswordController::class,'postEmail'])->name('forget-password');
Route::get('/reset-password/{token}', [ResetPasswordController::class,'getPassword'])->name('reset-password');
Route::post('/reset-password', [ResetPasswordController::class,'updatePassword'])->name('reset-password');
// Protected routes
Route::group(['middleware' => ['auth:client']], function () {
    Route::get('/available-rooms', [AvailableRoomAjaxController::class, 'index'])->name('ajaxavailablerooms.index');
    Route::get('/make-a-reservation', [AvailableRoomAjaxController::class, 'capacityForm']);
    Route::get('/my-reservations', [AvailableRoomAjaxController::class, 'getReservations'])->name('client.reservations');
    Route::get('/clients/{clientID}', [ClientController::class, 'edit'])->name('client.edit');
    Route::put('/clients/{clientID}', [ClientController::class, 'update'])->name('client.update');

    Route::get('/stripe-payment', [StripeController::class, 'handleGet']);
    Route::post('/stripe-payment', [StripeController::class, 'handlePost'])->name('stripe.payment');
});


// All admin routes
Route::get('/login/admin', [LoginController::class,'showAdminLoginForm'])->name('login.admin');
Route::post('/login/admin', [LoginController::class,'adminLogin'])->name('login.admin');
Route::get('/logout', [StaffLogoutController::class, 'logout'])->name('logout');
Route::group(['middleware' => ['auth:user']], function () {
    Route::get('/admin', function () {
        return view('admin-views.home');
    })->name('admin.home');
    
    Route::get('/admin/register', [StaffRegisterController::class, 'index'])->name('admin.index');
    Route::post('/admin/register', [StaffRegisterController::class, 'store'])->name('admin.store');
    
    //Managing rooms and floors
    Route::get('/manage-floors', [managingController::class, 'floors'])->name('manage.floors');
    Route::get('/manage-rooms', [managingController::class, 'rooms'])->name('manage.rooms');
    
    //Approving clients
    Route::get('/clients-proposals', [ClientController::class, 'NotApproved'])->name('clients.proposals');
    
    // Manager Routes
    Route::get('/managers', [ManagerAjaxController::class, 'index'])->name('managers.index');
    Route::get('/managers/{managerID}', [ManagerAjaxController::class, 'edit']);
    Route::put('/managers/{managerID}', [ManagerAjaxController::class, 'update']);
    Route::delete('/managers/{managerID}', [ManagerAjaxController::class, 'destroy']);
    
    // Receptionists Routes
    Route::get('/receptionists', [ReceptionistAjaxController::class, 'index'])->name('receptionists.index');
    Route::get('/receptionists/{receptionistID}', [ReceptionistAjaxController::class, 'edit']);
    Route::get('/receptionists/ban/{receptionistID}', [ReceptionistAjaxController::class, 'ban']);
    Route::get('/receptionists/unban/{receptionistID}', [ReceptionistAjaxController::class, 'unBan']);
    Route::put('/receptionists/{receptionistID}', [ReceptionistAjaxController::class, 'update']);
    Route::delete('/receptionists/{receptionistID}', [ReceptionistAjaxController::class, 'destroy']);
    
    Route::get('/receptionists/clientsreservations/{receptionistID}', [ReceptionistAjaxController::class, 'getClientsReservations'])->name('reservations');
});
