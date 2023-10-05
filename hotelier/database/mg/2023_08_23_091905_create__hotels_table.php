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
        Schema::create('Hotels', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("address");
            $table->text("description");
            $table->unsignedBigInteger("city_id");
            $table->unsignedBigInteger("hotel_type_id");
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('Cities');
            $table->foreign('hotel_type_id')->references('id')->on('Hotel_Types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Hotels');
    }
};
