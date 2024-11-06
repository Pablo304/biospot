<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('process_infos', function (Blueprint $table) {
            $table->foreignId('address_id')
                ->nullable()
                ->default(null)
                ->constrained('addresses')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('process_infos', function (Blueprint $table) {
            $table->dropForeign('process_infos_address_id_foreign');
        });
    }
};
