<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstallationMethod extends Model
{
    protected $fillable = [
        'name',
        'thumbnail',
        'order'
    ];
}
