<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMeasurment extends Model
{
    use HasFactory;

    protected $table = 'product_measurements';

    protected $fillable = [
        'width_in_cm',
        'depth_in_cm',
        'height_in_cm',
        'package_width_in_cm',
        'package_depth_in_cm',
        'package_height_in_cm',
        'package_weight_in_kg',
        'package_nos',
        'image',
        'product_id'
    ];
}
