<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Country extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'flag',
        'description',
        'benefits',
        'requirements',
        'order',
        'is_popular',
        'is_active',
    ];

    protected $casts = [
        'is_popular' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($country) {
            if (empty($country->slug)) {
                $country->slug = Str::slug($country->name);
            }
        });
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function universities()
    {
        return $this->hasMany(University::class);
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function scholarships()
    {
        return $this->hasMany(Scholarship::class);
    }
}