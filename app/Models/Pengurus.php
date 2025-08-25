<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    use HasFactory;

    protected $table = 'pengurus';

    protected $fillable = [
        // Step 1
        'title',
        'descroption', // Sesuai dengan nama kolom di migration (ada typo)
        'address',
        'phone',
        'email',
        'image',
        'fb',
        'ig',
        'tiktok',
        'yt',
        'category_daftar_id',
        'category_pengurus_id',

        // Step 2
        'title2',
        'title3',
        'description2',
        'description3',
        'image2',
        'image3',

        // Step 3
        'title4',
        'description4',
        'image4',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function categoryDaftar()
    {
        return $this->belongsTo(CategoryDaftar::class, 'category_daftar_id');
    }

    public function categoryPengurus()
    {
        return $this->belongsTo(CategoryPengurus::class, 'category_pengurus_id');
    }

    // Helper methods untuk step validation
    public function getStep1Fields()
    {
        return [
            'title',
            'descroption',
            'address',
            'phone',
            'email',
            'image',
            'fb',
            'ig',
            'tiktok',
            'yt',
            'category_daftar_id',
            'category_pengurus_id'
        ];
    }

    public function getStep2Fields()
    {
        return [
            'title2',
            'title3',
            'description2',
            'description3',
            'image2',
            'image3'
        ];
    }

    public function getStep3Fields()
    {
        return [
            'title4',
            'description4',
            'image4'
        ];
    }

    // Check if step is completed
    public function isStep1Completed()
    {
        $requiredFields = ['title', 'descroption', 'address', 'phone', 'email', 'category_daftar_id', 'category_pengurus_id'];
        foreach ($requiredFields as $field) {
            if (empty($this->$field)) {
                return false;
            }
        }
        return true;
    }

    public function isStep2Completed()
    {
        return !empty($this->title2) && !empty($this->title3);
    }

    public function isStep3Completed()
    {
        return !empty($this->title4);
    }
}
