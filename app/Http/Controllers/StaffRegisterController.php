<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StaffRegisterController extends Controller
{
    use UploadTrait;

    public function index()
    {
        if (Gate::allows('manage managers', Auth::guard('user')->user()) or Gate::allows('manage receptionists', Auth::guard('user')->user())) {
            return view('admin-views.register-staff');
        }
        abort(403);
    }

    public function store(StoreUserRequest $request)
    {
        if (Gate::allows('manage managers', Auth::guard('user')->user()) or Gate::allows('manage receptionists', Auth::guard('user')->user())) {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->assignRole(strtolower($request->role));
            $user->created_by = Auth::guard('user')->user()->id;
        
            if ($request->avatar_image) {
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
                $user->avatar_image = $filePath;
            }

            $user->save();
            return view('admin-views.register-staff');
        }
    }
}