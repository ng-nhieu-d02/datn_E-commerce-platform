<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankInfo extends Model
{
    use HasFactory;
    protected $table = 'bank_info';
    protected $fillable = [
        'id_payment',
        'name_bank',
        'stk',
        'chu_tk',
    ];
    public function payment()
    {
        return $this->belongsTo(PaymentStore::class, 'id_payment');
    }
}
