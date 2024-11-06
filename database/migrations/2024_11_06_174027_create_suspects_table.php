<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('suspects', function (Blueprint $table) {
            $table->id();
            $table->string('notes')->nullable()->default(null);
            $table->foreignId('complaint_id');
            $table->foreignId('status_id');
            $table->foreignId('process_info_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suspects');
    }
};
