<?php

namespace App\Traits;

use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    /**
     * Log an activity
     */
    public static function logActivity(
        string $action,
        string $description,
        $model = null,
        array $properties = null
    ) {
        $user = Auth::user();
        
        Activity::create([
            'user_id' => $user ? $user->id : null,
            'action' => $action,
            'model_type' => $model ? get_class($model) : null,
            'model_id' => $model ? $model->id : null,
            'description' => $description,
            'properties' => $properties,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    /**
     * Boot the trait and set up model event listeners
     */
    protected static function bootLogsActivity()
    {
        // Log when model is created
        static::created(function ($model) {
            $modelName = class_basename($model);
            $user = Auth::user();
            $userName = $user ? $user->name : 'System';
            
            self::logActivity(
                'created',
                "{$userName} created a new {$modelName}",
                $model,
                ['attributes' => $model->getAttributes()]
            );
        });

        // Log when model is updated
        static::updated(function ($model) {
            $modelName = class_basename($model);
            $user = Auth::user();
            $userName = $user ? $user->name : 'System';
            
            $changes = $model->getChanges();
            $original = collect($model->getOriginal())
                ->only(array_keys($changes))
                ->toArray();

            if (!empty($changes)) {
                self::logActivity(
                    'updated',
                    "{$userName} updated {$modelName}",
                    $model,
                    [
                        'old' => $original,
                        'new' => $changes
                    ]
                );
            }
        });

        // Log when model is deleted
        static::deleted(function ($model) {
            $modelName = class_basename($model);
            $user = Auth::user();
            $userName = $user ? $user->name : 'System';
            
            self::logActivity(
                'deleted',
                "{$userName} deleted {$modelName}",
                $model,
                ['attributes' => $model->getAttributes()]
            );
        });
    }
}

