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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade'); // Reference to the event
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Reference to the user making the reservation
            $table->unsignedBigInteger('reservation_id')->nullable(); // Reference to the related record
            $table->date('reservation_date')->nullable(); // Date the user is reserving for
            $table->time('reservation_time')->nullable(); // Time the user is reserving for
            $table->integer('number_of_people')->nullable(); // Number of attendees the user is reserving for
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Reservation status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
