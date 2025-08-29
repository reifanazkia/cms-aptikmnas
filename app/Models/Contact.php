<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contact';
    protected $fillable = [
        'email_dpp',
        'email_dpd',
        'alamat',
        'notlp',
        'url_ig',
        'url_yt',
        'url_fb',
        'url_in',
        'url_twit',
        'url_tiktok',
        'start_datetime',
        'end_datetime',

    ];
}
