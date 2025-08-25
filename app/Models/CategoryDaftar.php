<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryDaftar extends Model
{
    protected $table = 'daftar_dpd_categories';

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
