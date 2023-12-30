<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'cart_id',
        'sub_total',
        'sales_tax',
        'total'
    ];

    public function order_detail(){
        return $this->belongsTo(OrderDetail::class);
    }
}
