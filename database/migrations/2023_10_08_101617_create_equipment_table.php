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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('brand');
            $table->string('model');
            $table->string('serie');
            $table->unsignedBigInteger('provider_id');
            $table->string('prevent1');
            $table->string('prevent2');
            $table->string('file');
            $table->unsignedBigInteger('status');
            $table->text('daily')->nullable();
            $table->text('weekly')->nullable();
            $table->text('monthly')->nullable();
            $table->text('quarterly')->nullable();
            $table->text('biannual')->nullable();
            $table->text('annual')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
