<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TickerCreateStore extends Model
{
    use HasFactory;

    protected $table = 'ticket_create_store';

    protected $fillable = [
        'id_user',
        'id_store ',
        'message',
        'status',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class, 'id_store');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
