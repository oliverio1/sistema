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
        Schema::create('reagent_uses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reagent_detail_id');
            $table->date('use_date');
            $table->unsignedBigInteger('use_user_id');
            $table->date('fin_date')->nullable();
            $table->unsignedBigInteger('fin_user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reagent_uses');
    }
};
