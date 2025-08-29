<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryAboutus extends Model
{
    use HasFactory;

    protected $table = 'aboutus_categories';

    protected $fillable = ['name'];
}
