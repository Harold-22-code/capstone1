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
        Schema::create('confirmation_records', function (Blueprint $table) {
            $table->id();
            $table->year('year')->nullable();
            $table->date('date_of_confirmation')->nullable();
            $table->string('name')->nullable();
            $table->string('parish_of_baptism')->nullable();
            $table->string('province_of_baptism')->nullable();
            $table->string('place_of_baptism')->nullable();
            $table->string('parents')->nullable();
            $table->string('sponsor')->nullable();
            $table->string('name_of_minister')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('confirmation_records');
    }
};
