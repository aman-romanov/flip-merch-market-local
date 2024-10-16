<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('color_id');
            $table->unsignedBigInteger('size_id');
            $table->unsignedBigInteger('sex_id');
            $table->unsignedBigInteger('count');

            #$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            #$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            #$table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
            #$table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');
            #$table->foreign('sex_id')->references('id')->on('sexes')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
