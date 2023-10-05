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
        Schema::create('Room_Types', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->unsignedBigInteger("num_bed");
            $table->unsignedBigInteger("num_bath_room");
            $table->text('image')->nullable();
            $table->unsignedBigInteger("capactity");
            $table->unsignedBigInteger("area");
            $table->string("view");
            $table->unsignedBigInteger("hotel_id");
            $table->unsignedBigInteger("city_id");

            $table->timestamps();

            $table->foreign('hotel_id')->references('id')->on('Hotels');
            $table->foreign('city_id')->references('id')->on('Cities');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Room_Types');
    }
};
