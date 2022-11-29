<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStore extends Model
{
    use HasFactory;

    protected $table = 'order_store';

    protected $fillable = [
        'id_order',
        'id_store',
        'id_coupons',
        'coupons_price',
        'total_price',
        'ship',
        'id_coupon_frs',
        'coupon_frs_price',
        'message',
        'status_order',
        'status_payment_store',
    ];
    public function store()
    {
        return $this->belongsTo(Store::class, 'id');
    }
    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class);
    }
}
