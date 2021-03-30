<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
<<<<<<< Updated upstream
      
=======
>>>>>>> Stashed changes
        Auth::guard('client')->logout();
        return redirect()->route('index');
    }
}