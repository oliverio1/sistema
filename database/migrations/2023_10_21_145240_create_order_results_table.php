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
        Schema::create('order_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('study_id');
            $table->unsignedBigInteger('order_study_id');
            $table->unsignedBigInteger('orden');
            $table->string('resultado');
            $table->string('alert');
            $table->string('analito_id');
            $table->string('min');
            $table->string('max');
            $table->string('analito');
            $table->string('text');
            $table->string('units');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_results');
    }
};
