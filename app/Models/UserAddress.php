<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $table = 'user_address';

    protected $fillable = [
        "name",
        "city",
        "district",
        "address",
        "status",
        "user_id",
        "phone",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
