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
        Schema::create('Rooms', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->boolean("status");
            $table->decimal('price', 10, 2);
            $table->text("description");
            $table->unsignedBigInteger("quantity");
            $table->unsignedBigInteger("area");
            $table->string("view");
            $table->unsignedBigInteger("hotel_id");
            $table->timestamps();

            $table->foreign('hotel_id')->references('id')->on('Hotels');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Rooms');
    }
};
