<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMeta extends Model
{
    use HasFactory;

    protected $table = 'product_metas';

    protected $fillable = [
        'product_details',
        'designer',
        'good_to_know',
        'material',
        'care',
        'assembly_instructions',
        'other',
        'product_id'
    ];
}
