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
        $table->string('name');
        $table->date('Birth_Date');
        $table->date('Baptism_Date');
        $table->string('Fathers_Name');
        $table->string('Mothers_Name');
        $table->string('Church_Name');
        $table->string('Sponsor')->nullable();
        $table->string('Secondary_Sponsor')->nullable();
        $table->string('Priest_Name');
        $table->integer('Book_Number');
        $table->integer('Page_Number');
        $table->integer('Line_Number');
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
