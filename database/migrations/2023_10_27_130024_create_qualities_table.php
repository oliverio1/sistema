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
        Schema::create('qualities', function (Blueprint $table) {
            $table->id();
            $table->string('numeral');
            $table->string('type');
            $table->string('name');
            $table->string('document');
            $table->string('release_date');
            $table->string('revision_date');
            $table->unsignedBigInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qualities');
    }
};
