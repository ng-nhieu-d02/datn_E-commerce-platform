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
        Schema::create('status_shipping', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_order')->unsigned();
            $table->string('message');
            $table->timestamps();
        });
        Schema::table('status_shipping', function ($table) {
            $table->foreign('id_order')->references('id')->on('order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_shipping');
    }
};
