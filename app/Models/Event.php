<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_title',
        'event_image',
        'event_description',
        'event_date',
        'sub_location',
        'institute_id',
    ];

    // Relationship to Institute
    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    // Cast event_date as a date
    protected $casts = [
        'event_date' => 'datetime',
    ];
}
