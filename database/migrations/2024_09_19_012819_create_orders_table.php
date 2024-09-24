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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->dateTime('order_date');
            $table->enum('status' , ['pending' , 'shipped' , 'delivered' , 'cancelled']);
            $table->string('total_amount');
            $table->enum('payment_method' , ['credit-card' , 'cash-on-delivery'])->default('credit-card');
            $table->enum('pay_status' , ['paid' , 'pending' , 'failed']);
            $table->text('delivery_address');
            $table->string('copen');
            $table->string('copen_price');
            $table->string('final_price');
            $table->float('star' , 5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
