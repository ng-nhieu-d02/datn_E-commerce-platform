<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreCate extends Model
{
    use HasFactory;

    protected $table = 'store_cate';
    
    protected $fillable = [
        "id_store",
        "name",
        "slug"
    ];

    public function store()
    {
        return $this->belongsTo(Store::class, 'id_store');
    }
}
