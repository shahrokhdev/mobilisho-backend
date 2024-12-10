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
        Schema::create('copens', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->enum('state', ['unexpire', 'expired']);
            $table->enum('discount_type', ['percentage', 'fixed_amount', 'free_shipping', 'buy_one_get_one']);
            $table->string('discount_value');
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('usage_limit')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('copens');
    }
};
