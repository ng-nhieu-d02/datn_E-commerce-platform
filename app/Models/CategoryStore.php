<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryStore extends Model
{
    use HasFactory;

    protected $table = 'category_store';

    public function store()
    {
        return $this->belongsToMany(Store::class, 'store_cate', 'id_category_store', 'id_store')->withTimestamps();
    }

}
