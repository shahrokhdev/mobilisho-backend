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
        Schema::create('copen_customer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('copen_id');
            $table->unsignedBigInteger('customer_id');
            $table->timestamps();
            $table->foreign('copen_id')->references('id')->on('copens')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('copen_customer');
    }
};
