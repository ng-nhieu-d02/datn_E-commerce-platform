<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $fillable = [
        'id_store',
        'create_by',
        'name',
        'slug',
        'description',
        'long_description',
        'type',
        'category_path',
        'category_id',
        'thumb',
        'brand',
        'origin',
        'title',
        'keyword',
    ];

    // public static function boot()
    // {
    //     parent::boot();
    
    //     static::deleting(function ($coupon) {
    //        dd($coupon);    
    //     });
    // }

    public function detail()
    {
        return $this->hasMany(ProductDetail::class, 'id_product');
    }

    public function color()
    {
        return $this->hasMany(ProductDetail::class, 'id_product')->groupBy('color_value');
    }

    public function attributes()
    {
        return $this->hasMany(ProductDetail::class, 'id_product')->groupBy('attribute');
    }

    public function attribute_values()
    {
        return $this->hasMany(ProductDetail::class, 'id_product')->groupBy('attribute_value');
    }

    public function price_minmax($id)
    {
        return ProductDetail::select(DB::raw('MIN(price) as min_price, MIN(sale) as min_sale, Max(sale) as max_sale, MAX(price) as max_price'))->where('id_product', $id)->first();
    }

    public function images()
    {
        return $this->hasMany(ProductImages::class, 'id_product');
    }

    public function comment()
    {
        return $this->hasMany(CommentProduct::class, 'id_product');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'id_store');
    }

    public function categoryProduct()
    {
        return $this->belongsTo(CategoryProduct::class, 'category_id')->withDefault();
    }
}
