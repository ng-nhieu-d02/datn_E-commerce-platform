<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_detail';
    protected $fillable = [
        'id_order',
        'id_order_store',
        'id_product',
        'id_product_detail',
        'quantity',
        'price',
        'status'
    ];
}
