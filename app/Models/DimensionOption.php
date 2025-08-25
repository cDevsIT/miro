<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DimensionOption extends Model
{
    protected $fillable = [
        'name',
        'thumbnail',
        'diagram',
        'order'
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        static::addGlobalScope('order', function ($query) {
            $query->orderBy('order', 'asc');
        });
    }
}
