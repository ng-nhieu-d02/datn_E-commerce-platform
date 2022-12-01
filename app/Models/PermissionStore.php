<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionStore extends Model
{
    use HasFactory;

    protected $table = 'permission_store';

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
