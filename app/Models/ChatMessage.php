<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;
    protected $table = 'chat_message';
    protected $fillable = [
        'id_room',
        'id_user',
        'type',
        'message',
        'status'
    ];
    public function room()
    {
        return $this->belongsTo(ChatRoom::class, 'id_room');
    }
}
