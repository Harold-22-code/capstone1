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
        Schema::create('baptismal_records', function (Blueprint $table) {
              $table->id();
        $table->string('name')->nullable();
        $table->date('Birth_Date')->nullable();
        $table->date('Baptism_Date')->nullable();
        $table->string('Fathers_Name')->nullable();
        $table->string('Mothers_Name')->nullable();
        $table->string('Church_Name')->nullable();
        $table->string('Sponsor')->nullable();
        $table->string('Secondary_Sponsor')->nullable();
        $table->string('Priest_Name')->nullable();
        $table->integer('Book_Number')->nullable();
        $table->integer('Page_Number')->nullable();
        $table->integer('Line_Number')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baptismal_records');
    }
};
