<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Glorand\Model\Settings\Traits\HasSettingsTable;

class Domain extends Model
{
    use HasFactory, HasApiTokens;
    use HasSettingsTable;
    protected $fillable = ['name','url'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function gettokenAttribute(){
        return $this->currentAccessToken();
    }

    public function chatusers(){
        return $this->hasMany(ChatUser::class,'domain_id');
    }
}
