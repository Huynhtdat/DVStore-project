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
        Schema::create('products_size', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_color_id')->unsigned();
            $table->foreign('product_color_id')->references('id')->on('products_color');
            $table->bigInteger('size_id')->unsigned();
            $table->integer('quantity');
            $table->foreign('size_id')->references('id')->on('sizes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_size');
    }
};
