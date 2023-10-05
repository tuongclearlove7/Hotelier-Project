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
            $table->string("image");
            $table->string("address");
            $table->text("description");
            $table->unsignedBigInteger("hotel_type_id")->nullable();
            $table->unsignedBigInteger("city_id")->nullable();
            $table->timestamps();

            $table->foreign('hotel_type_id')->references('id')->on('Hotel_Types');
            $table->foreign('city_id')->references('id')->on('Cities');

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
