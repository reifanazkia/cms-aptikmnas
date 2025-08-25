<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryPengurus extends Model
{
    protected $table = 'pengurus_categories';

    protected $fillable = [
        'name',
        'image',
        'notlp',
        'email',
        'yt',
        'fb',
        'ig',
        'tiktok',
    ];
}
