<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_number',
        'room_price',
        'room_capacity',
        'floor_id',
        'created_by',
        'is_reserved',
    ];

    public function manager()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by'); // created_by was provided as second argument because Eloquent auto assumes foreign key name to be _id
    }

    public function floor()
    {
        return $this->belongsTo(\App\Models\Floor::class);
    }
}
