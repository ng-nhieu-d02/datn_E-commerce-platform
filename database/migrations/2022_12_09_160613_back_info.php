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
        Schema::create('bank_info', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_payment')->unsigned();
            $table->string('name_bank');
            $table->string('stk');
            $table->string('chu_tk');
            $table->timestamps();
        });
        Schema::table('bank_info', function ($table) {
            $table->foreign('id_payment')->references('id')->on('payment_store');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_info');
    }
};
