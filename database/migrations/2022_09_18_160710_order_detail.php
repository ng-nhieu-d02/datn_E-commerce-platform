<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_order')->unsigned();
            $table->bigInteger('id_order_store')->unsigned();
            $table->bigInteger('id_product')->unsigned();
            $table->bigInteger('id_product_detail')->unsigned();
            $table->integer('quantity');
            $table->integer('price');
            $table->enum('status', [0,1])->comment('0 là hiện, 1 là ẩn');
            $table->timestamps();
        });
        Schema::table('order_detail', function ($table) {
            $table->foreign('id_order')->references('id')->on('order');
            $table->foreign('id_order_store')->references('id')->on('order_store');
            $table->foreign('id_product')->references('id')->on('product');
            $table->foreign('id_product_detail')->references('id')->on('product_detail');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_detail');
    }
};
