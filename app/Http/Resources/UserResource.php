<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       $createdBy = User::find($this->created_by);
        return [
            'name' => $this->name,
            'email' => $this->email,
            'national_id' => $this->national_id,
            'created_by' => [
                'name' => $createdBy->name,
                'email' => $createdBy->email,
                'national_id' => $createdBy->national_id,
            ],
        ];
    }
}