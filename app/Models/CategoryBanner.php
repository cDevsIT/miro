<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryBanner extends Model
{
    protected $fillable = [
        'category_id',
        'image_path',
        'alt_text',
        'order'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
