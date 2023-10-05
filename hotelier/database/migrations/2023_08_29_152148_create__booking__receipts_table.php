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
            $table->string('number_card');
            $table->dateTime('expiry_date');
            $table->decimal('total_money', 15, 2);
            $table->dateTime('booking_now');
            $table->text('role_user_key');
            $table->unsignedBigInteger("payment_method_status")->nullable();
            $table->unsignedBigInteger("flag_status")->nullable();
            $table->unsignedBigInteger("booking_id")->nullable();
            $table->unsignedBigInteger("bank_id")->nullable();
            $table->timestamps();

            $table->foreign('booking_id')->references('id')->on('Bookings');
            $table->foreign('bank_id')->references('id')->on('Banks');
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
