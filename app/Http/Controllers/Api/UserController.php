<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Client;
use App\Models\User;
use App\Notifications\AccountApproved;
use Illuminate\Http\Request;

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

    public function approve(Request $request, Client $client)
    {
        Client::where('id', $client->id)->update([
            'approved_by'=>$request->all()['approved_by'],
            'approval_status'=>$request->all()['approval_status'],
        ]);

        $client->notify(new AccountApproved($client->name));

        return response()->json(['message' => 'Client propsal approved!']);
    }

    public function decline(Request $request, Client $client)
    {
        Client::where('id', $client->id)->update([
            'approved_by'=>$request->all()['approved_by'],
            'approval_status'=>$request->all()['approval_status'],
        ]);
        return response()->json(['message' => 'Client propsal declined!']);
    }
}
