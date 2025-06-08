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
        Schema::create('burial_records', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->date('date_of_death')->nullable();
            $table->date('date_of_burial')->nullable();
            $table->integer('age')->nullable();
            $table->string('status')->nullable();
            $table->string('informant')->nullable();
            $table->string('place')->nullable();
            $table->string('presider')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('burial_records');
    }
};
