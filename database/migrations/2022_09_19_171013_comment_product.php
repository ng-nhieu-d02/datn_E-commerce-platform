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
        Schema::create('comment_product', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('create_by')->unsigned();
            $table->bigInteger('id_store')->unsigned();
            $table->bigInteger('id_product')->unsigned();
            $table->longText('message');
            $table->string('derImg');
            $table->timestamps();
        });
        Schema::table('comment_product', function ($table) {
            $table->foreign('create_by')->references('id')->on('users');
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
        Schema::dropIfExists('comment_product');
    }
};
