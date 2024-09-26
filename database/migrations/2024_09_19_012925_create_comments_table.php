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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->default(0);
            $table->foreign('user_id')->references('id')->on("users")->onDelete('cascade');
            $table->unsignedBigInteger('commentable_id')->default(1);
            $table->string('commentable_type')->nullable();
            $table->integer(column: 'parent')->default(0);
            $table->text('comment');
            $table->enum('status' , ['pending' , 'approved'] )->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
