<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Kolom yang boleh diisi mass assignment
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Sembunyikan saat array/json
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casts modern Laravel: password otomatis di-hash
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
