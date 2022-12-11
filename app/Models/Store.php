<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $table = 'store';

    protected $fillable = [
        "name",
        "slug",
        "avatar",
        "background",
        "slogan",
        "money",
        "address",
        "city",
        "district",
        "status"
    ];

    public function boss()
    {
        return $this->hasMany(PermissionStore::class, 'id_store');
    }

    public function store_cate()
    {
        return $this->hasMany(StoreCate::class, 'id_store');
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
        return $this->hasMany(Product::class, 'id_store')->orderBy('id', 'DESC');
    }
    public function order()
    {
        return $this->hasMany(OrderStore::class, 'id_store');
    }
}
