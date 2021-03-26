<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'client_id',
        'paid_price',
        'accompany_number',
    ];

    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class);
    }

    public function room()
    {
        return $this->belongsTo(\App\Models\Room::class);
    }
}
