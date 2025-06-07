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
            $table->year('year');
            $table->date('date_of_marriage');
            $table->string('husband_name');
            $table->string('wife_name');
            $table->string('husband_status');
            $table->string('wife_status');
            $table->integer('husband_age');
            $table->integer('wife_age');
            $table->string('municipality');
            $table->string('barangay');
            $table->string('husband_parents');
            $table->string('wife_parents');
            $table->string('sponsor1');
            $table->string('sponsor2');
            $table->string('place_of_sponsor');
            $table->string('presider');
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
