<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TickerCreateStore extends Model
{
    use HasFactory;

    protected $table = 'ticket_create_store';

    public function store()
    {
        return $this->belongsTo(Store::class, 'id_store');
    }
}
