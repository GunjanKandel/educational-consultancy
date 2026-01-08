<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'team_id',
        'consultation_type',
        'appointment_date',
        'appointment_time',
        'message',
        'status',
    ];

    protected $casts = [
        'appointment_date' => 'date',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
