<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffLogoutController extends Controller
{
    public function logout(Request $request)
    {
        Auth::guard('user')->user()->tokens()->delete();
        Auth::guard('user')->logout();
        return redirect()->route('login.admin');
    }
}
