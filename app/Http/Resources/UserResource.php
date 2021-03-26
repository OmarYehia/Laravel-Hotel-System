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
        return [
            'name' => $this->name,
            'email' => $this->email,
            'national_id' => $this->national_id,
            'is_banned' => $this->isBanned,
            'created_by' => new App\Http\Resources\UserResource(User::find($this->created_by)),
        ];
    }
}
