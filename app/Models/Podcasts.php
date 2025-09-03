<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use HasFactory;

    protected $table = 'podcasts';

    protected $fillable = [
        'title',
        'description',
        'yt_id',
        'pub_date',
        'pembicara',
        'category_podcasts_id',
    ];

    protected $casts = [
        'pub_date'   => 'date',
        'pembicara'  => 'array', // otomatis cast JSON ke array/collection
    ];

    /**
     * Relasi ke kategori podcast
     */
    public function category()
    {
        return $this->belongsTo(CategoryPodcasts::class, 'category_podcasts_id');
    }
}
