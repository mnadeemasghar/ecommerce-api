<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id'
    ];

    public function product_images(){
        return $this->hasMany(ProductImage::class);
    }
    public function product_3d_images(){
        return $this->hasMany(Product3dImage::class,"product_id");
    }
}
