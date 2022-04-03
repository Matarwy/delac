<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMsg extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'msg',
        'sender_id',
        'seen',
    ];
    protected $table = 'chat_msg';
}
