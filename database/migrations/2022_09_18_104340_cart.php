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
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user')->unsigned();
            $table->bigInteger('id_store')->unsigned();
            $table->bigInteger('id_product')->unsigned();
            $table->bigInteger('id_product_detail')->unsigned();
            $table->integer('quantity');
            $table->enum('status', [0,1])->comment('0 là chưa chọn, 1 là đã chọn')->default(0);
            $table->timestamps();
        });
        Schema::table('cart', function ($table) {
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_store')->references('id')->on('store');
            $table->foreign('id_product_detail')->references('id')->on('product_detail');
            $table->foreign('id_product')->references('id')->on('product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart');
    }
};
