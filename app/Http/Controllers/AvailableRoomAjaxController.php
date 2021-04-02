<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoomResource;
use Illuminate\Http\Request;
use App\Models\Room;
use Yajra\DataTables\Facades\DataTables;


class AvailableRoomAjaxController extends Controller
{
    public function getCapacity()
    {
        return view('client-views.capacityForm');
    }
    
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Room::where([['is_reserved','=','0']])->latest()->get();  
            $data = RoomResource::collection($data);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row['id'].'" data-original-title="Book" class="edit btn btn-primary btn-sm bookRoom">Book</a>';
   
                        
                        return $btn;
                    })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('client-views.availablerooms');
    }
    

}
