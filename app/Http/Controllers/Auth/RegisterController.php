<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Client;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

use App\Traits\UploadTrait;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;



class RegisterController extends Controller
{
    use UploadTrait;

    public function __construct()
    {
       // $this->middleware(['guest:client']);
    }
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
           'email' => 'required|email|max:255|unique:clients',
           'phone_number' => 'required',
           'counrty' => 'requird',
           'gender' => 'required',
           'password' => 'required|confirmed',
           'avatar_image' =>  'image|mimes:jpeg,png,jpg,gif|max:2048'
       ]);

        //store client
        $client = new Client;
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone_number = $request->phone_number;
        $client->country = $request->country;
        $client->gender = $request->gender;
        $client->password = Hash::make($request->password);

        if ($request->has('avatar_image')) {
            // Get image file
            $image = $request->file('avatar_image');
            // Make a image name based on user name and current timestamp
            $name = Str::slug($request->input('name')).'_'.time();
            // Define folder path
            $folder = '/uploads/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $client->avatar_image = $filePath;
        }
        // Persist user record to database
        $client->save();
        
        //sign the client in
        Auth::guard('client')->attempt($request->only('email', 'password'));
       
}
}
