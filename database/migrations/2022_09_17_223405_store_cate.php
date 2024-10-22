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
        Schema::create('store_cate', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_store')->unsigned();
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });
        Schema::table('store_cate', function ($table) {
            $table->foreign('id_store')->references('id')->on('store');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_cate');
    }
};
