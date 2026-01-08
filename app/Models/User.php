<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',           // ADD THIS
        'is_active',      // ADD THIS
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    // Helper method to check if user is admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Helper method to check if user is manager
    public function isManager()
    {
        return $this->role === 'manager';
    }
}