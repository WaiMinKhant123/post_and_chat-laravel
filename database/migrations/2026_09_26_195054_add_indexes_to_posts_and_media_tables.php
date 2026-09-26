<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // posts ဇယားအတွက် Index များ ထည့်ခြင်း
        Schema::table('posts', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('category_id');
        });

        // media ဇယားအတွက် Index များ ထည့်ခြင်း
        Schema::table('media', function (Blueprint $table) {
            $table->index('post_id');
            $table->index('user_id');
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['category_id']);
        });

        Schema::table('media', function (Blueprint $table) {
            $table->dropIndex(['post_id']);
            $table->dropIndex(['user_id']);
        });
    }
};