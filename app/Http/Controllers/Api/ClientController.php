<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Client;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
{
    public function index()
    {
        $res = Client::get();
    }

    public function NotApproved(Request $request)
    {
        if ($request->ajax()) {
            $data = Client::where('approval_status', 'pending')->get();
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

    public function edit()
    {
        $client = Client::where('id', Auth::guard('client')->user()->id)->first();
        return view('client-views.editInfo', ['client' => $client]);
    }

    public function update(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:clients,email,' . Auth::guard('client')->user()->id, 'email'],
            'phone_number' => ['required'],
            'avatar_image' => ['image', 'mimes:jpeg,jpg', 'max:2048'],
        ]);

        $client = Client::where('id', Auth::guard('client')->user()->id)->first();
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone_number = $request->phone_number;
        $client->password = Hash::make($request->password);
        if ($request->avatar_image) {
            $image = $request->file('avatar_image');
            $name = Str::slug($request->input('name')).'_'.time();
            $folder = '/uploads/images/';
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);
            $client->avatar_image = $filePath;
        }

        $client->save();
        return response()->json([
            'success' => 'User updated successfully',
        ]);
    }

    public function show(Client $client)
    {
        if ($client) {
            dd($client);
        } else {
            dd("Client not found");
        }
    }

    public function show_client_reservations($clientID)
    {
        $reservations = Reservation::with(['client', 'room'])->where('client_id', '=', $clientID)->get();
        
        return ReservationResource::collection($reservations);
    }
}
