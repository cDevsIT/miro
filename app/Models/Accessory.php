<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class Accessory extends Model
{
    use LogsActivity;
    
    protected $fillable = [
        'name',
        'thumbnail',
        'order'
    ];
}
