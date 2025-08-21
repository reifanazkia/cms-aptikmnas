<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'gallery'; // Using your table name from migration

    protected $fillable = [
        'display_on_home',
        'title',
        'description',
        'image',
        'pub_date',
        'url',
        'category_gallery_id',
    ];

    protected $casts = [
        'display_on_home' => 'boolean',
        'pub_date' => 'date',
    ];

    /**
     * Get the category that owns the gallery item.
     */
    public function category()
    {
        return $this->belongsTo(CategoryGallery::class, 'category_gallery_id');
    }

    /**
     * Scope a query to only include items displayed on home.
     */
    public function scopeDisplayOnHome($query)
    {
        return $query->where('display_on_home', true);
    }

    /**
     * Scope a query to order by publication date.
     */
    public function scopeOrderByPubDate($query, $direction = 'desc')
    {
        return $query->orderBy('pub_date', $direction);
    }
}
