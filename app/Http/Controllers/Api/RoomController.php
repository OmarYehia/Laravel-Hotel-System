<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Models\Room;
use Validator;

class RoomController extends Controller
{
    public function store(StoreRoomRequest $request)
    {

        // $validator = Validator::make($request->all(), [
        //     'room_number' => 'required|min:4|integer',
        //     'room_price' => 'required|integer',
        //     'room_capacity' => 'required|integer',
        //     'floor_id' => 'required|exists:floors,id',
        //     'created_by' => 'required|exists:users,id',
        // ]);

        // if ($validator->fails()) {
        //     dd($validator);
        // }
        try {
            $room = Room::create([
                'room_number' => $request->room_number,
                'room_price' => $request->room_price,
                'room_capacity' => $request->room_capacity,
                'floor_id' => $request->floor_id,
                'created_by' => $request->created_by,
            ]);
        } catch (Exception $e) {
            dd($e);
            return false;
        }
    }
}
