<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FamilyProduct extends Model
{
    protected $fillable = [
        'model_no',
        'power',
        'slot',
        'dimensions_lwh',
        'dimensions_qh',
        'cut_hole_in_mm',
        'cut_hole_in_diameter',
        'mounting_type',
        'voltage'
    ];
}
