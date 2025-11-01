<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class Attribute extends Model
{
    use LogsActivity;
    
    protected $fillable = ['name', 'details', 'order'];
} 