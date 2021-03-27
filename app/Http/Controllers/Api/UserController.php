<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Resources;

class UserController extends Controller
{
    public function index()
    {
        $res = User::get();
        return UserResource::collection($res);
    }

    public function store(StoreUserRequest $request)
    {
        $res = User::create($request->all());
        return new UserResource($res);
    }

    public function show(User $userid)
    {
        $user = $userid;
        return new UserResource($user);
    }

    public function update(StoreUserRequest $request, User $userid)
    {
        $userid->update($request->all());
        return response()->json(['message' => 'Updated successfully!']);
        //Same as destroy method
    }

    public function destroy(User $userid)
    {
        /*

        Foriegn key ruins the delete, suggest adding on delete cascade;

        $userid->isBanned = 1;
        $userid->delete();
        $userid->save();
        */
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
