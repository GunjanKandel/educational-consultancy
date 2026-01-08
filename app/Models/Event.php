<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'type',
        'event_date',
        'venue',
        'online_link',
        'capacity',
        'registered',
        'featured_image',
        'is_active',
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title);
            }
        });
    }

    public function isUpcoming()
    {
        return $this->event_date > now();
    }

    public function isFull()
    {
        return $this->capacity && $this->registered >= $this->capacity;
    }
}