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
        Schema::create('analito_references', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('analito_id');
            $table->string('sex');
            $table->string('age_in');
            $table->string('age_fin');
            $table->string('min');
            $table->string('max');
            $table->string('text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analito_references');
    }
};
