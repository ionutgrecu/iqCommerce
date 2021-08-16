<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail {

    use HasFactory,
        Notifiable;

    protected $guarded = [
        'id', 'remember_token', 'created_at', 'updated_at'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

}
