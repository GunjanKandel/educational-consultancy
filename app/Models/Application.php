<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'application_number',
        'course_id',
        'country_id',
        'full_name',
        'email',
        'phone',
        'date_of_birth',
        'address',
        'nationality',
        'passport_number',
        'highest_qualification',
        'gpa_percentage',
        'english_test',
        'english_score',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'gpa_percentage' => 'decimal:2',
        'english_score' => 'decimal:1',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
