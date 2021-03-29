<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        //  $this->middleware('guest:client')->except('logout');
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
        
        if (!Auth::guard('client')->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('status', 'Invalid login details');
        }
       
        $client =Client::where('email', $request->email) -> first();
      
        $client->update([
            'last_login_date' => Carbon::now()->toDateTimeString(),
        ]);
        Auth::guard('client')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'));
        return redirect()->route('index');
    }
}