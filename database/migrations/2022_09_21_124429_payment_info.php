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
        Schema::create('payment_info', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_order')->unsigned();
            $table->string('amount');
            $table->string('id_payment_vnpay');
            $table->string('id_payment_bank');
            $table->string('status');
            $table->string('message');
            $table->timestamps();
        });
        Schema::table('payment_info', function ($table) {
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
