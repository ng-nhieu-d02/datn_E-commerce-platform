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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_store')->unsigned();
            $table->bigInteger('create_by')->unsigned();
            $table->string('name');
            $table->string('slug');
            $table->longText('description');
            $table->longText('long_description');
            $table->enum('type',[0,1,2])->comment('0 là có màu + size, 1 là có màu không size, 2 là có size không màu')->default(0);
            $table->string('category_path');
            $table->bigInteger('category_id')->unsigned();
            $table->string('thumb');
            $table->float('rate')->default(0);
            $table->integer('total_rate')->default(0);
            $table->integer('like')->default(0);
            $table->bigInteger('view')->default(0);
            $table->integer('sold')->default(0);
            $table->string('brand');
            $table->string('origin');
            $table->string('title')->comment('on sale');
            $table->string('keyword')->comment('on sale');
            $table->enum('status', [0,1])->comment('0 là hiện, 1 là ẩn')->default(0);
            $table->timestamps();
        });
        Schema::table('product', function ($table) {
            $table->foreign('create_by')->references('id')->on('users');
            $table->foreign('id_store')->references('id')->on('store');
            $table->foreign('category_id')->references('id')->on('category_product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
};
