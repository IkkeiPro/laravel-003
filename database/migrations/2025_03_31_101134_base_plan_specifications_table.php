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
        Schema::create('base_plan_specifications', function (Blueprint $table) {
            $table->id();
            $table->enum('category', ['exterior', 'interior', 'equipment']);
            $table->foreignId('base_plan_id')->constrained()->onDelete('cascade');
            $table->foreignId('specification_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('base_plan_specifications');
    }
};
