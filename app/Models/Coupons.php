<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    use HasFactory;

    protected $table = 'coupons';

    protected $fillable = [
        'create_by_user',
        'apply_store',
        'code',
        'name',
        'avatar',
        'type',
        'message',
        'money_apply_start',
        'money_apply_end',
        'value',
        'max_price',
        'quantity',
        'remaining_quantity',
        'start_time',
        'stop_time',
        'coupon_type',
        'apply_with',
        'user_id',
        'status'
    ];
    public static function boot()
    {
        parent::boot();
    
        static::deleting(function ($coupon) {
            unlink('upload/voucher/'.$coupon->avatar);         
        });
    }
}
