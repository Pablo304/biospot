<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('source_procedure_situations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('source_procedure_id')->constrained('source_procedures');
            $table->foreignId('source_situation_id')->constrained('source_situations');
            $table->foreignId('next_source_procedure_id')->constrained('source_procedures');
            $table->foreignId('status_id')->constrained('source_statuses');
            $table->boolean('ends_complaint')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('source_procedure_situations');
    }
};
