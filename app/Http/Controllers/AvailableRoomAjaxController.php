<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoomResource;
use Illuminate\Http\Request;
use App\Models\Room;
use Yajra\DataTables\Facades\DataTables;


class AvailableRoomAjaxController extends Controller
{
    public function index(Request $request)
    {
      
        if ($request->ajax()) {
            $data = Room::where('is_reserved','0')->latest()->get();
            $data = RoomResource::collection($data);
            return DataTables::of($data)
                ->addIndexColumn()
               /* ->addColumn('action', function ($row) {
                        $btn = '<a href="/api/floors/'.$row->id.'" class="edit btn btn-primary btn-sm">View</a>';
                        $btn = $btn.'<a href="" class="edit btn btn-primary btn-sm">Edit</a>';
                        $btn = $btn.'<a href="/api/floors/'.$row->id.'/delete" class="edit btn btn-primary btn-sm">Delete</a>';
     
                        return $btn;
                    })
                ->rawColumns(['action'])*/
                ->make(true);
        }
      
        return view('client-views.availablerooms');
    }
    

}
