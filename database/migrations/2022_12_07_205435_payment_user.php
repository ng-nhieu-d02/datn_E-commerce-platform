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
        Schema::create('payment_user', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user')->unsigned();
            $table->string('amount');
            $table->enum('type', [0,1])->comment('0 là cộng tiền, 1 là rút');
            $table->string('description');
            $table->enum('status', [0,1,2])->default(0)->comment('0 là đang, 1 là thành công, 2 là thất bại');
            $table->timestamps();
        });
        Schema::table('payment_user', function ($table) {
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_user');
    }
};
