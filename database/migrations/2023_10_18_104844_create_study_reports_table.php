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
        Schema::create('study_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('study_id');
            $table->integer('orden');
            $table->string('analito');
            $table->string('text')->nullable();
            $table->string('units');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('study_reports');
    }
};
