<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'gallery';

    protected $fillable = [
        'title',
        'description',
        'image',
        'pub_date',
        'waktu_baca',
        'category_gallery_id',
    ];

    protected $casts = [
        'pub_date' => 'date',
    ];

    /**
     * Relasi ke kategori galeri.
     */
    public function category()
    {
        return $this->belongsTo(CategoryGallery::class, 'category_gallery_id');
    }

    /**
     * Scope urutkan berdasarkan tanggal publikasi.
     */
    public function scopeOrderByPubDate($query, $direction = 'desc')
    {
        return $query->orderBy('pub_date', $direction);
    }
}
