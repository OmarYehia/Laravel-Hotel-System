<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReservationResource;
use App\Http\Resources\RoomResource;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AvailableRoomAjaxController extends Controller
{
    public function capacityForm()
    {
        return view('client-views.capacityForm');
    }
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $capacity = $request->all()['capacity'];
            $data = Room::where([['is_reserved','=','0']])->where('room_capacity', '>=', $capacity)->latest()->get();
            $data = RoomResource::collection($data);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('room_price', function ($row) {
                    return ($row['room_price'] / 100);
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row['id'].'" data-original-title="Book" class="edit btn btn-primary btn-sm bookRoom">Book</a>';
   
                        
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('client-views.availablerooms', ['request' => $request]);
    }

    public function getReservations(Request $request)
    {
        if ($request->ajax()) {
            $data = Reservation::with(['client', 'room'])
                ->where("client_id", Auth::guard('client')->user()->id)
                ->latest()
                ->get();
            $data = ReservationResource::collection($data);
            $res = Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('room_number', function ($row) {
                    return $row['room']->room_number;
                })
                ->addColumn('floor_name', function ($row) {
                    return $row['room']->floor->floor_name;
                })
                ->addColumn('paid_price', function ($row) {
                    return ($row['paid_price'] / 100 . " $");
                })
                ->addColumn('reservation_date', function ($row) {
                    return $row['reservation_date']->diffForHumans();
                })
                ->make(true);
            return $res;
        }

        return view('client-views.my-reservations');
    }
}
