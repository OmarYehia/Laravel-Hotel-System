<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Client;
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
        $userid->delete();
        return response()->json(['message' => 'Deleted successfully!']);
    }

    public function retrieve()
    {
        $users=User::onlyTrashed()->get();
        foreach ($users as $user) {
            User::withTrashed()->find($user->id)->restore();
        }
        return response()->json(['message' => 'Restored successfully!']);
    }

    public function approve($client)
    {
        if (Client::where('approval_status', 'pending')->where('id', $client)->exists()) {
            $affected = Client::where('approval_status', 'pending')->where('id', $client)->update(['approval_status' => 'approved']);
            return response()->json(['message' => 'Client propsal approved!']);
        } else {
            return response()->json(['message' => 'Client doesnt exist!']);
        }
    }
}
