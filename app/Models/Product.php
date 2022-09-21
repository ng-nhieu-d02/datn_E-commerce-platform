<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    public function detail()
    {
        return $this->hasMany(ProductDetail::class, 'id_product')->withDefault();
    }

    public function color()
    {
        return $this->hasMany(ProductDetail::class, 'id_product')->groupBy('color_value')->withDefault();
    }

    public function size()
    {
        return $this->hasMany(ProductDetail::class, 'id_product')->groupBy('size_value')->withDefault();
    }

    public function images()
    {
        return $this->hasMany(ProductImages::class, 'id_product')->withDefault();
    }

    public function comment()
    {
        return $this->hasMany(CommentProduct::class, 'id_product');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'id_store');
    }

}
