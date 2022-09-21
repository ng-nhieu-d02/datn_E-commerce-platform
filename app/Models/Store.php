<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    
    protected $table = 'store';

    public function store_cate()
    {
        return $this->belongsToMany(CategoryStore::class, 'store_cate' , 'id_store', 'id_category_store')->withTimestamps();
    }
    public function ticket()
    {
        return $this->hasOne(TickerCreateStore::class, 'id_store');
    }
    public function comment()
    {
        return $this->hasMany(CommentProduct::class, 'id_store');
    }
    public function product()
    {
        return $this->hasMany(Product::class, 'id_store');
    }
}
