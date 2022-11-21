<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentInfo extends Model
{
    use HasFactory;
    protected $table = 'payment_info';
    protected $fillable = [
        'id_order',
        'amount',
        'id_payment_vnpay',
        'id_payment_bank',
        'status',
        'message'
    ];
}
