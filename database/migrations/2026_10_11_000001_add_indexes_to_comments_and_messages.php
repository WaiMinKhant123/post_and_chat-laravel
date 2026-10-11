<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->index('post_id');
            $table->index('user_id');
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->index('sender_id');
            $table->index('receiver_id');
            $table->index('read_at');
        });
    }

    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropIndex(['post_id']);
            $table->dropIndex(['user_id']);
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->dropIndex(['sender_id']);
            $table->dropIndex(['receiver_id']);
            $table->dropIndex(['read_at']);
        });
    }
};
