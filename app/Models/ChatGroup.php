<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatGroup extends Model
{
    use HasFactory;

    public function chatusers()
    {
        return $this->belongsToMany(ChatUser::class,'chat_users_chat_groups','chat_group_id','chat_user_id');
    }
}
