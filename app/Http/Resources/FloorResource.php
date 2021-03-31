<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class FloorResource extends JsonResource
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
            'floor_name' => $this->floor_name,
            'floor_manager' => new UserResource(User::find($this->floor_manager)),
            'created_by' => new UserResource(User::find($this->created_by)),
        ];
    }
}
