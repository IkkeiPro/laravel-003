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
        Schema::create('specifications_meisai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('specification_id')->constrained()->onDelete('cascade');
            $table->integer('line_no');
            $table->string('name');
            $table->integer('price');
            $table->tinyInteger('is_enabled')->default(1);
            $table->tinyInteger('is_default')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('specifications_meisai');
    }
};
