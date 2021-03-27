<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        Auth::guard('client')->guest();
    }

    public function index()
    {
       
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
       if(!Auth::guard('client')->attempt($request->only('email', 'password'), $request->remember)){
           return back()->with('status', 'Invalid login details');
       }
      
       dd("logged in successfully");
       
    }
}
