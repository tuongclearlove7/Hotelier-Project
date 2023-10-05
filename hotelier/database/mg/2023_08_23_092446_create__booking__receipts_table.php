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
        Schema::create('Booking_Receipts', function (Blueprint $table) {
            $table->id();
            $table->dateTime("checkout");
            $table->boolean('cancel_time_status');
            $table->boolean('payment_status');
            $table->unsignedBigInteger("booking_id");
            $table->timestamps();

            $table->foreign('booking_id')->references('id')->on('Bookings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Booking_Receipts');
    }
};
