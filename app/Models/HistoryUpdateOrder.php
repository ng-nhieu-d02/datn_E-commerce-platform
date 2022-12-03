<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryUpdateOrder extends Model
{
    use HasFactory;
    protected $table = 'history_update_order';
    protected $fillable = [
        'id_order',
        'create_by',
        'content'
    ];
}
