<?php

namespace App\Http\Resources;

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
            'floor_name' => $this->floor_name,
            'floor_manager' => $this->floor_manager,
            'created_by' => $this->created_by,
        ];
    }
}
