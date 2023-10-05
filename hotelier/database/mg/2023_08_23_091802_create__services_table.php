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
        Schema::create('Services', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->text("image");
            $table->decimal('price', 10, 2);
            $table->unsignedBigInteger("service_type_id");
            $table->timestamps();

            $table->foreign('service_type_id')->references('id')->on('Service_Types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Services');
    }
};
