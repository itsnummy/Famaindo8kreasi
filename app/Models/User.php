<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable // HAPUS: implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',  // Ganti 'name' dengan 'username'
        'email',
        'password',
    ];

    // Kolom yang disembunyikan
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casting
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}