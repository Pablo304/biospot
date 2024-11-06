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
        Schema::create('organization_suspects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('suspect_id')->constrained('suspects');
            $table->foreignId('organization_id')->constrained('organizations');
            $table->string('relation_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_suspects');
    }
};
