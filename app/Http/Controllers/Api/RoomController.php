<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\Response;

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
            return [$room];
        } catch (Exception $e) {
            return false;
        }
    }

    public function index()
    {
        $allRooms = Room::with(['user', 'floor'])->get();
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
}
