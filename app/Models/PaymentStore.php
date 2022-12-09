<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentStore extends Model
{
    use HasFactory;
    protected $table = 'payment_store';
    protected $fillable = [
        'id_store',
        'create_by',
        'amount',
        'type',
        'description',
        'status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'create_by');
    }
    public function bank()
    {
        return $this->hasOne(BankInfo::class, 'id_payment');
    }
    public function store()
    {
        return $this->belongsTo(Store::class, 'id_store');
    }
}
