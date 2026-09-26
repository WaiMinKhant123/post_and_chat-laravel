<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // PostgreSQL အတွက် avatar ကို nullable ဖြစ်စေရန်
        DB::statement('ALTER TABLE users ALTER COLUMN avatar DROP NOT NULL;');
    }

    public function down()
    {
        DB::statement('ALTER TABLE users ALTER COLUMN avatar SET NOT NULL;');
    }
};