<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Client;
use DB;  
use Hash; 


class ResetPasswordController extends Controller
{
    public function getPassword($token)
     { 

        return view('auth.reset-password', ['token' => $token]);
     }
    
     public function updatePassword(Request $request)
     {
        
   
        $request->validate([
            'email' => 'required|email|exists:clients',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
   
        ]); 

        $updatePassword = DB::table('password_resets')
           ->where(['email' => $request->email, 'token' => $request->token])
            ->first();

         if(!$updatePassword)
         
           return back()->withInput()->with('error', 'Invalid token!');

        $client =Client::where('email', $request->email) -> first();
        
        $client->update([
            'password'  => Hash::make($request->password),
        ]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return redirect('login')->with('message', 'Your password has been changed!');

     }
}