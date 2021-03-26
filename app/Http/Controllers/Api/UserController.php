<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $res = User::all();
        dd($res);
    }

    public function store(StoreUserRequest $request)
    {
        User::create($request->all());
    }

    public function show($userid)
    {
        $user = User::find($userid);
        if ($user) {
            dd($user);
        } else {
            dd("User not found");
        }
    }

    public function update($userid)
    {
        //Same as destroy method
    }

    public function destroy($userid)
    {
        /*

        Foriegn key ruins the delete, suggest adding on delete cascade;

        $record = User::find($userid);
        $record->isBanned = 1;
        $record->delete();
        $record->save();
        $record = User::find($userid);
        dd($record);*/
    }

    public function retrieve()
    {/*

        $blogs=User::onlyTrashed()->get();
        foreach ($blogs as $blog) {
            User::withTrashed()->find($blog->id)->restore();
        }
        return redirect()->route('blogs.index');
        
    */
    }
}
