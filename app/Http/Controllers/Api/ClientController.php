<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientRequest;
use App\Http\Resources\UserResource;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $res = Client::get();
        dd($res);
    }

    public function store(StoreClientRequest $request)
    {
        $res = Client::create($request->all());
        dd($res);
    }

    public function show(Client $client)
    {
        if ($client) {
            dd($client);
        } else {
            dd("Client not found");
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
