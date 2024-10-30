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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('discount_id')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->text(column: 'description');
            $table->text(column: 'image')->nullable();
            $table->string(column: 'price');
            $table->integer(column: 'inventory');
            $table->integer('best_selling')->default(0);
            $table->integer(column: 'view_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
