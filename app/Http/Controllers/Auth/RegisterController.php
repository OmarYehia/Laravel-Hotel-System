<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Client;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function index()
    {
         // Get all countries 
        $countries = countries(); 
        return view('auth.register',[
            'countries' =>  $countries
        ]);
    }
    public function store(Request $request)
    {
        //validation
       $this->validate($request, [
           'name' => 'required|max:255',
           'email' => 'required|email|max:255',
           'phone_number' => 'required',
           'counrty' => 'requird',
           'gender' => 'required',
           'password' => 'required|confirmed',
       ]);

        //store client
        Client::create ([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phonenumber,
            'country' => $request->country,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),//hash facad

        ]);
        //sign the user in

        //user facad  Auth::
       // auth()->attempt($request->only('email', 'password'));
        //redirect
       // return redirect()->route('dashboard');
       dd("done");
    }
}
