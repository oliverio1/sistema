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
        Schema::create('studies', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name')->unique();
            $table->unsignedBigInteger('area_id');
            $table->string('label');
            $table->integer('delivery');
            $table->integer('maquila');
            $table->string('lab_code');
            $table->unsignedBigInteger('provider_id');
            $table->unsignedBigInteger('status');
            $table->double('price',8,2);
            $table->unsignedBigInteger('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studies');
    }
};
