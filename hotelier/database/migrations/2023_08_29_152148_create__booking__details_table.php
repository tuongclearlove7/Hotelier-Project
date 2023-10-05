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
        Schema::create('Booking_Details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("room_id")->nullable();
            $table->unsignedBigInteger("service_id")->nullable();
            $table->unsignedBigInteger("booking_id")->nullable();

            $table->timestamps();

            $table->foreign('room_id')->references('id')->on('Rooms');
            $table->foreign('service_id')->references('id')->on('Services');
            $table->foreign('booking_id')->references('id')->on('Bookings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Booking_Details');
    }
};
