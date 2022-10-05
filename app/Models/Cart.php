<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';

    protected $fillable = [
        'id_user',
        'id_store',
        'id_product',
        'id_product_detail',
        'quantity',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function detail()
    {
        return $this->belongsTo(ProductDetail::class, 'id_product_detail');
    }

    public function cart($store)
    {
        return $this->hasMany(Cart::class, 'id_user', 'id_user')->where('id_store', $store)->orderBy('created_at','desc')->get();
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'id_store');
    }
}
