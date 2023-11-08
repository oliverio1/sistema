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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('social');
            $table->string('service');
            $table->string('contact');
            $table->string('position');
            $table->string('email');
            $table->string('phone');
            $table->string('contact2')->nullable();
            $table->string('position2')->nullable();
            $table->string('email2')->nullable();
            $table->string('phone2')->nullable();
            $table->string('bank')->nullable();
            $table->string('bank_count')->nullable();
            $table->string('clabe')->nullable();
            $table->text('address')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('status');
            $table->string('provider_file')->nullable();;
            $table->text('observation')->nullable();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
