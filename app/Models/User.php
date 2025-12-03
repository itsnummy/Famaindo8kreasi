<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user'; // Gunakan tabel 'user' bukan 'users'
    
    protected $fillable = [
        'nama',
        'role',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    // Helper method untuk cek role admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}