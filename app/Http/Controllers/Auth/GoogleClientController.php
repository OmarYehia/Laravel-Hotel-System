<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\Client;
use Auth\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleClientController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $client = Socialite::driver('google')->user();
        } catch (Exception $e) {
            return redirect()->route("auth.register");
        }

        $authClient = $this->findOrCreateUser($client);
     

        Auth::guard('client')->login($authClient, true);
        
        return redirect()->route('index');
    }

    private function findOrCreateUser($googleClient)
    {
        if ($authClient = Client::where('google_account', $googleClient->email)->first()) {
            return $authClient;
        }
        
        return Client::create([
            'google_account' => $googleClient->email,
            "name" => $googleClient->name,
            "email" => $googleClient->email,
            "country" => "usinggoogleaccount",
            "gender" => "male",
            "phone_number" => "usinggoogleaccount",
            "password" =>Hash::make("usinggoogleaccount"),
            "last_login_date" => Carbon::now()->toDateTimeString(),
        ]);
    }
}
