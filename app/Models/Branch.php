<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'city',
        'state',
        'country',
        'phone',
        'email',
        'map_url',
        'is_main',
        'is_active',
        'order', // Add this line
    ];

    protected $casts = [
        'is_main' => 'boolean',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}