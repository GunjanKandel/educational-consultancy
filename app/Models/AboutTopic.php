<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutTopic extends Model
{
    protected $fillable = ['title', 'icon', 'description', 'is_active','order'];
    protected $casts = ['is_active' => 'boolean'];
}
