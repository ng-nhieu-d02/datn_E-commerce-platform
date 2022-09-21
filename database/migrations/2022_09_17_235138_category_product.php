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
        Schema::create('category_product', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->integer('parent_id')->default(0);
            $table->string('path');
            $table->bigInteger('create_by')->unsigned();
            $table->string('avatar')->default('687f3967b7c2fe6a134a2c11894eea4b_tn.png');
            $table->string('title')->comment('on sale');
            $table->string('keyword')->comment('on sale');
            $table->enum('status', [0,1])->comment('0 là hiện, 1 là ẩn')->default(0);
            $table->timestamps();
        });
        Schema::table('category_product', function ($table) {
            $table->foreign('create_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_product');
    }
};
