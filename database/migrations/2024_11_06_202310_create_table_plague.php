<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plagues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plague_type_id');
            $table->unsignedBigInteger('suspect_id')->nullable()->default(null);
            $table->unsignedBigInteger('process_info_id');
            $table->unsignedBigInteger('plague_status_id');

            $table->foreign('plague_type_id')->references('id')->on('plague_types');
            $table->foreign('suspect_id')->references('id')->on('suspects')->nullOnDelete();
            $table->foreign('process_info_id')->references('id')->on('process_infos');
            $table->foreign('plague_status_id')->references('id')->on('plague_statuses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plagues');
    }
};
