<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\Request;
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
}
