<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class University extends Model
{
    protected $fillable = [
        'country_id',
        'name',
        'slug',
        'description',
        'logo',
        'location',
        'world_ranking',
        'website',
        'partnership_level',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($university) {
            if (empty($university->slug)) {
                $university->slug = Str::slug($university->name);
            }
        });
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function scholarships()
    {
        return $this->hasMany(Scholarship::class);
    }
}