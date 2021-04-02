<?php

namespace App\Http\Resources;

use App\Models\Floor;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'room_number' => $this->room_number,
            'room_price' => $this->room_price,
            'room_capacity' => $this->room_capacity,
            'is_reserved' => ($this->is_reserved)?"Yes":"No",
            'floor_id' => $this->floor_id,
            'floor' => new \App\Http\Resources\FloorResource(Floor::find($this->floor_id)),
            'created_by' => new \App\Http\Resources\UserResource(User::find($this->created_by)),
        ];
    }
}
