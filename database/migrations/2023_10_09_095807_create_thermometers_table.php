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
        Schema::create('thermometers', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('brand');
            $table->string('model');
            $table->string('serie');
            $table->unsignedBigInteger('provider_id');
            $table->string('calibration');
            $table->string('file');
            $table->unsignedBigInteger('status');
            $table->text('format_code')->nullable();
            $table->text('min_temp')->nullable();
            $table->text('max_temp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thermometers');
    }
};
