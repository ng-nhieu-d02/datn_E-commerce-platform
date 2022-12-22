<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatRoom extends Model
{
    use HasFactory;
    protected $table = 'chat_room';
    protected $fillable = [
        'id_store',
        'id_user',
        'status',
    ];
    public function new_message($id_room)
    {
        return ChatMessage::where('id_room', '=', $id_room)->orderBy('id', 'DESC')->first();
    }
    public function all_message()
    {
        return $this->hasMany(ChatMessage::class, 'id_room');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function store()
    {
        return $this->belongsTo(Store::class, 'id_store');
    }
}
