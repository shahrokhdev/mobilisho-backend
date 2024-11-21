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
            $table->unsignedBigInteger('customer_id')->default(0);
            $table->unsignedBigInteger('discount_id')->default(0);
            $table->dateTime('order_date');
            $table->enum('status' , ['paid','pending','shipped','delivered','cancelled'])->default('pending');
            $table->string('total_amount');
            $table->enum('payment_method' , ['credit-card' , 'cash-on-delivery'])->default('credit-card');
            $table->text('delivery_address')->nullable();
            $table->string('final_price');
            $table->string('copen_code')->nullable();
            $table->text('copen_reason')->nullable();
            $table->boolean('copen_status')->default(0);
            $table->integer('star')->nullable();
            $table->string('tracking_serial')->nullable();
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
