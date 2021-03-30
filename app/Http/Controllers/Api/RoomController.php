<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\Response;
use Yajra\DataTables\Facades\DataTables;

class RoomController extends Controller
{
    public function store(StoreRoomRequest $request)
    {
        try {
            $room = Room::create([
                'room_number' => $request->room_number,
                'room_price' => $request->room_price,
                'room_capacity' => $request->room_capacity,
                'floor_id' => $request->floor_id,
                'created_by' => $request->created_by,

            ]);
            return new RoomResource($room);
        } catch (Exception $e) {
            return false;
        }
    }

    public function index()
    {
        $allRooms = Room::with(['manager', 'floor'])->get();
        return RoomResource::collection($allRooms);
    }

    public function show(Room $room)
    {
        return new RoomResource($room);
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return response()->json(['message' => 'Deleted successfully!']);
    }

    public function update(StoreRoomRequest $request, Room $room)
    {
        $room->update($request->all());
        return response()->json(['message' => 'Updated successfully!']);
    }

    public function dataTable(Request $request)
    {
        if ($request->ajax()) {
            $data = Room::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                        $btn = '<a href="/api/floors/'.$row->id.'" class="edit btn btn-primary btn-sm">View</a>';
                        $btn = $btn.'<a href="" class="edit btn btn-primary btn-sm">Edit</a>';
                        $btn = $btn.'<a href="/api/floors/'.$row->id.'/delete" class="edit btn btn-primary btn-sm">Delete</a>';
     
                        return $btn;
                    })
                ->rawColumns(['action'])
                ->make(true);
        }
      
        return view('client-views.reservations');
    }
}
