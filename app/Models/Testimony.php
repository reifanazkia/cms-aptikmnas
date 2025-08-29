<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    use HasFactory;

    protected $table = 'testimonies';

    protected $fillable = [
        'display_homepage',
        'category_dpd_id',
        'name',
        'title',
        'description',
        'image',
    ];

    /**
     * Relasi ke tabel daftar_dpd_categories
     */
    public function category()
    {
        return $this->belongsTo(CategoryDaftar::class, 'category_dpd_id');
    }
}
