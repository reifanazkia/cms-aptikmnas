<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
     protected $fillable = [
        'title',
        'description',
        'start_datetime',
        'end_datetime',
        'event_organizer',
        'location',
        'youtube_link',
        'type',
        'image',
    ];
}
