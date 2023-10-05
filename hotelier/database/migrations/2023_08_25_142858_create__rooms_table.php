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
            $table->unsignedBigInteger("room_type_id")->nullable();
            $table->timestamps();

            $table->foreign('room_type_id')->references('id')->on('room_types');

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
