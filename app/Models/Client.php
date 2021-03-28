<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;



class Client extends Authenticatable 
{
    use HasFactory, Notifiable;
    
    protected $guard = 'client';

    protected $fillable = [
        'name',
        'email',
        'password',
        'country',
        'gender',
        'phone_number',
        'avatar_image',
        'last_login_date'
    ];
     
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getImageAttribute()
{
   return $this->avatar_image;
}

    
}
