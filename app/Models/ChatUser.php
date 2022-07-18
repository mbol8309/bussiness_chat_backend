<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatUser extends Model
{
    use HasFactory;

    public function domain()
    {
        return $this->belongsTo(Domain::class,'domain_id');
    }

    public function chatgroups()
    {
        return $this->belongsToMany(ChatGroup::class,'chat_users_chat_groups','chat_user_id','chat_group_id');
    }
}
