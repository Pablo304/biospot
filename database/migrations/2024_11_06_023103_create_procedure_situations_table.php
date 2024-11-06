<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('procedure_situations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('source_procedure_situation_id')->constrained('source_procedure_situations');
            $table->foreignId('procedure_id')->constrained('procedures');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('procedure_situations');
    }
};
