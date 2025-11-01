<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'model_type',
        'model_id',
        'description',
        'properties',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'properties' => 'array',
        'created_at' => 'datetime',
    ];

    /**
     * Get the user that performed the activity
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the subject model
     */
    public function subject()
    {
        return $this->morphTo('model');
    }

    /**
     * Scope to filter by action
     */
    public function scopeOfAction($query, $action)
    {
        return $query->where('action', $action);
    }

    /**
     * Scope to filter by model type
     */
    public function scopeOfModelType($query, $modelType)
    {
        return $query->where('model_type', $modelType);
    }

    /**
     * Scope to filter by date range
     */
    public function scopeBetweenDates($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    /**
     * Get icon based on action
     */
    public function getIconAttribute()
    {
        return match($this->action) {
            'created' => 'fa-plus-circle',
            'updated' => 'fa-edit',
            'deleted' => 'fa-trash',
            'logged_in' => 'fa-sign-in-alt',
            'logged_out' => 'fa-sign-out-alt',
            default => 'fa-info-circle',
        };
    }

    /**
     * Get color class based on action
     */
    public function getColorClassAttribute()
    {
        return match($this->action) {
            'created' => 'text-success',
            'updated' => 'text-primary',
            'deleted' => 'text-danger',
            'logged_in' => 'text-info',
            'logged_out' => 'text-secondary',
            default => 'text-dark',
        };
    }
}
