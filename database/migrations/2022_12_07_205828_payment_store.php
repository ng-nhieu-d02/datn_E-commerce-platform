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
        Schema::create('payment_store', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_store')->unsigned();
            $table->bigInteger('create_by')->unsigned();
            $table->bigInteger('amount');
            $table->enum('type', [0,1])->comment('0 là cộng tiền, 1 là rút');
            $table->string('description');
            $table->enum('status', [0,1,2])->default(0)->comment('0 là đang, 1 là thành công, 2 là thất bại');
            $table->timestamps();
        });
        Schema::table('payment_store', function ($table) {
            $table->foreign('create_by')->references('id')->on('users');
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
        Schema::dropIfExists('payment_store');
    }
};
