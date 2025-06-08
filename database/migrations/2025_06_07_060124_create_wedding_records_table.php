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
        Schema::create('wedding_records', function (Blueprint $table) {
              $table->id();
            $table->year('year')->nullable();
            $table->date('date_of_marriage')->nullable();
            $table->string('husband_name')->nullable();
            $table->string('wife_name')->nullable();
            $table->string('husband_status')->nullable();
            $table->string('wife_status')->nullable();
            $table->integer('husband_age')->nullable();
            $table->integer('wife_age')->nullable();
            $table->string('municipality')->nullable();
            $table->string('barangay')->nullable();
            $table->string('husband_parents')->nullable();
            $table->string('wife_parents')->nullable();
            $table->string('sponsor1')->nullable();
            $table->string('sponsor2')->nullable();
            $table->string('place_of_sponsor')->nullable();
            $table->string('presider')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wedding_records');
    }
};
