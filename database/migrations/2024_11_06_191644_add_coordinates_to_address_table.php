<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('alter table addresses add column coordinates point null;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('alter table addresses drop column coordinates;');
    }
};
