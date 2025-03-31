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
        Schema::create('consultation_users', function (Blueprint $table) {
            $table->id();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('last_name_kana');
            $table->string('first_name_kana');
            $table->string('phone_number', 15);
            $table->string('email');
            $table->string('zip_code', 8);
            $table->string('address1');
            $table->string('address2');
            $table->string('address3')->nullable();
            $table->enum('contact_method', ['email', 'phone']);
            $table->enum('build_schedule', ['within_1_year', 'after_1_year']);
            $table->boolean('has_build_location');
            $table->foreignId('selected_plan_id')->constrained('base_plans');
            $table->integer('total_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('consultation_users');
    }
};
