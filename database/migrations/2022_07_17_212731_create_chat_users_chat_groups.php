<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_users_chat_groups', function (Blueprint $table) {
            $table->foreignId('chat_user_id')->constrained('chat_users');
            $table->foreignId('chat_group_id')->constrained('chat_groups');
            $table->unique(['chat_user_id','chat_group_id']);
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_users_chat_groups');
    }
};
