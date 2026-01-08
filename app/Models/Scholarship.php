<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Scholarship extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'country_id',
        'university_id',
        'amount',
        'currency',
        'eligibility_criteria',
        'application_deadline',
        'required_documents',
        'is_active',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'application_deadline' => 'date',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($scholarship) {
            if (empty($scholarship->slug)) {
                $scholarship->slug = Str::slug($scholarship->title);
            }
        });
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function isExpired()
    {
        return $this->application_deadline < now();
    }
}
