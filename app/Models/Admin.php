<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        "name",
        "email",
        "role",
        "password"
    ];

    protected $hidden = [
        "password",
        "remeber_token"
    ];

    protected $casts = [
        "password" => "hashed",
        "created_at" => "datetime",
        "updated_at" => "datetime",
        'email_verified_at' => 'datetime',
    ];
}
