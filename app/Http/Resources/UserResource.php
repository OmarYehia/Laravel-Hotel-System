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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'national_id' => $this->national_id,
            'created_by' => [
                'id' => ($createdBy->id) ? ($createdBy->id) : null,
                'name' => ($createdBy->name) ? ($createdBy->name) : null,
                'email' => ($createdBy->email) ? ($createdBy->email) : null,
                'national_id' => ($createdBy->national_id) ? ($createdBy->national_id) : null,
            ],
        ];
    }
}
