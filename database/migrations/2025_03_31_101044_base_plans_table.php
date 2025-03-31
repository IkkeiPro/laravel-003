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
        //
        Schema::create('base_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price_standard');
            $table->text('comment')->nullable();
            $table->decimal('floor_area_1f', 8, 2);
            $table->decimal('floor_area_2f', 8, 2)->nullable();
            $table->string('image_url_1f')->nullable();
            $table->string('image_url_2f')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('base_plans');
    }
};
