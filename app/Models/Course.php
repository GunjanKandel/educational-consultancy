<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    protected $fillable = [
        'country_id',
        'name',
        'slug',
        'description',
        'duration',
        'fee',
        'currency',
        'requirements',
        'image',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'fee' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($course) {
            if (empty($course->slug)) {
                $course->slug = Str::slug($course->name);
            }
        });
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }
}

