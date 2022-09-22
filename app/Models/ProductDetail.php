<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    protected $table = 'product_detail';

    public static function boot()
    {
        parent::boot();
    
        static::deleting(function ($productDetail) {
            unlink('upload/product/'.$productDetail->url_image);
            try {
                rmdir('upload/product/'.$productDetail->id_product);
            } catch (Exception $e) {

            };            
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
