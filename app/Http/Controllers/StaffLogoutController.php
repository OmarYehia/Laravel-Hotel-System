<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffLogoutController extends Controller
{
    public function logout(Request $request)
<<<<<<< Updated upstream
      {
        
         Auth::guard('user')->logout();
         return redirect()->route('index');
      }
}
=======
    {
        Auth::guard('user')->logout();
        return redirect()->route('login.admin');
    }
}
>>>>>>> Stashed changes
