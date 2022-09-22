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
        return $this->hasMany(ProductDetail::class, 'id_product');
    }

    public function color()
    {
        return $this->hasMany(ProductDetail::class, 'id_product')->groupBy('color_value');
    }

    public function size()
    {
        return $this->hasMany(ProductDetail::class, 'id_product')->groupBy('size_value');
    }

    public function images()
    {
        return $this->hasMany(ProductImages::class, 'id_product');
    }

    public function comment()
    {
        return $this->hasMany(CommentProduct::class, 'id_product')->where('parent_id', 0);
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'id_store');
    }

}
