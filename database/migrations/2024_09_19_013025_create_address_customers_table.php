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
        Schema::create('address_customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger(column: 'city_id');
            $table->unsignedBigInteger('town_id');
            $table->string('street');
            $table->string('alley');
            $table->string('plaque');
            $table->string('floor');
            $table->string('unit');
            $table->string('lat');
            $table->string('lng');
            $table->text('description');
            /*             $table->enum('state' , ['']); */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address_customers');
    }
};
