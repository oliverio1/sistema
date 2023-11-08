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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('folio')->unique();
            $table->string('clave')->nullable();
            $table->string('name');
            $table->string('pater')->nullable();
            $table->string('mater')->nullable();
            $table->string('sex');
            $table->string('age');
            $table->string('birthdate');
            $table->string('phone')->nullable();
            $table->string('mail')->nullable();
            $table->string('medic_id')->nullable();
            $table->string('client_id');
            $table->string('observation')->nullable();
            $table->string('user_id');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
