<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'title',
        'title_suffix',
        'model_number',
        'thumbnail',
        'description',
        'brochure',
        'view_3d',
        'is_active',
        'order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class)
            ->withPivot('value')
            ->withTimestamps();
    }

    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class);
    }

    public function reflectorColors(): BelongsToMany
    {
        return $this->belongsToMany(ReflectorColor::class);
    }

    public function dimensionOptions(): BelongsToMany
    {
        return $this->belongsToMany(DimensionOption::class);
    }

    public function familyProducts(): BelongsToMany
    {
        return $this->belongsToMany(FamilyProduct::class);
    }

    public function accessories(): BelongsToMany
    {
        return $this->belongsToMany(Accessory::class);
    }

    public function installationMethods(): BelongsToMany
    {
        return $this->belongsToMany(InstallationMethod::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('order');
    }

    public function wishedBy(): BelongsToMany
    {
        return $this->belongsToMany(Customer::class, 'wishlists')
            ->withTimestamps();
    }
}
