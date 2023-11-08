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
        Schema::create('analito_calculos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('study_id');
            $table->string('analito');
            $table->string('formula');
            $table->unsignedBigInteger('decimales');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analito_calculos');
    }
};
