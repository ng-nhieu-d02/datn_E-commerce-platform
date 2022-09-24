<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'Cart';

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function cart($store)
    {
        return $this->hasMany(Cart::class, 'id_user', 'id_user')->where('id_store', $store)->get();
    }
}
