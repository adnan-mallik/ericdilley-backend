<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpeakingRequest extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'organization',
        'event_type',
        'event_date',
        'expected_attendees',
        'event_location',
        'budget_range',
        'additional_details',
    ];
}
