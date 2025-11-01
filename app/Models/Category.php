<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class Category extends Model
{
    use LogsActivity;
    protected $fillable = [
        'name',
        'details',
        'thumbnail',
        'banner',
        'link',
        'type',
        'order',
        'parent_id'
    ];

    // Add constants for type options
    const TYPE_INDOOR = 'indoor';
    const TYPE_OUTDOOR = 'outdoor';

    // Add helper method to get type options
    public static function getTypeOptions()
    {
        return [
            self::TYPE_INDOOR => 'Indoor Product',
            self::TYPE_OUTDOOR => 'Outdoor Product',
        ];
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function banners()
    {
        return $this->hasMany(CategoryBanner::class)->orderBy('order');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }
} 