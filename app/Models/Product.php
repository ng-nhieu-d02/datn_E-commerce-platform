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

    public function images()
    {
        return $this->hasMany(ProductImages::class, 'id_product')->withDefault();
    }
}
