<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Domain extends Model
{
    use HasFactory, HasApiTokens;

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function gettokenAttribute(){
        return $this->currentAccessToken();
    }
}
