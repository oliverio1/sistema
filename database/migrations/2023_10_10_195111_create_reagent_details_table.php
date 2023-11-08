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
        Schema::create('reagent_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reagent_id');
            $table->unsignedBigInteger('cantidad');
            $table->unsignedBigInteger('used');
            $table->unsignedBigInteger('finished');
            $table->string('lote');
            $table->date('caducidad');
            $table->unsignedBigInteger('recibio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reagent_details');
    }
};
