<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientRequest;
use App\Http\Resources\ReservationResource;
use App\Http\Resources\UserResource;
use App\Models\Client;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
{
    public function index()
    {
        $res = Client::get();
        dd($res);
    }

    public function NotApproved(Request $request)
    {
        if ($request->ajax()) {
            $data = Client::where('approval_status','pending')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" clientId="'.$row->id.'" data-id="'.$row->id.'" data-email="'.$row->email.'" data-clientName="'.$row->name.'"  data-original-title="Approve" class="edit btn btn-primary btn-sm approveClient actionBtn">Approve</a>';
                    $btn = $btn.'<a href="javascript:void(0)" clientId="'.$row->id.'" data-id="'.$row->id.'" data-email="'.$row->email.'" data-clientName="'.$row->name.'" data-original-title="Decline" class="edit btn btn-danger btn-sm declineClient actionBtn">Decline</a>';
     
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin-views.clients');    
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

    public function show_client_reservations($clientID)
    {
        $reservations = Reservation::with(['client', 'room'])->where('client_id', '=', $clientID)->get();
        
        return ReservationResource::collection($reservations);
    }
}