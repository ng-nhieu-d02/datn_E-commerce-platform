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
        Schema::create('product_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_product')->unsigned();
            $table->string('color_value')->nullable();
            $table->string('attribute')->nullable();
            $table->string('attribute_value')->nullable();
            $table->integer('weight');
            $table->integer('quantity');
            $table->integer('sold')->default(0);
            $table->integer('price');
            $table->integer('sale');
            $table->string('url_image');
            $table->enum('status', [0,1])->comment('0 là hiện ,1 là ẩn');
            $table->timestamps();
        });
        Schema::table('product_detail', function ($table) {
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
        Schema::dropIfExists('product_detail');
    }
};
