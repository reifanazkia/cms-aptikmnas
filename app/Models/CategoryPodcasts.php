<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryPodcasts extends Model
{
    protected $table = 'podcasts_categories';

    protected $fillable = ['name'];
}
