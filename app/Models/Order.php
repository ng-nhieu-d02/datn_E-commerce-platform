<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';

    protected $fillable = [
        'create_by',
        'address',
        'name',
        'phone',
        'email',
        'id_coupons',
        'coupons_price',
        'total_price',
        'ship',
        'id_coupon_frs',
        'coupons_frs_price',
        'payment_method',
        'payment_status',
        'status_order',
        'status_payment_store'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'create_by');
    }
    public function orderStore()
    {
        return $this->hasMany(OrderStore::class, 'id_order');
    }
    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }

}
