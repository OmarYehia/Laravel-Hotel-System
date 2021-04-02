<?php

namespace App\Http\Resources;

use App\Models\Room;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
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
            'client' => $this->client_id,
            'paid_price' => $this->paid_price,
            'accompany_number' => $this->accompany_number,
            'reservation_date' => $this->created_at,
            'room' => new \App\Http\Resources\RoomResource(Room::with('floor')->where('id', $this->room_id)->first()),
        ];
    }
}
