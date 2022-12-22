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
        Schema::create('chat_message', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_room')->unsigned();
            $table->bigInteger('id_user')->unsigned();
            $table->enum('type', [0,1])->comment('0 là user gửi, 1 là shop gửi');
            $table->longText('message');
            $table->enum('status', [0,1,2,3])->comment('0 là đã gửi, 1 là đã nhận, 2 là đã xem');
            $table->timestamps();
        });
        Schema::table('chat_message', function ($table) {
            $table->foreign('id_room')->references('id')->on('chat_room');
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
        Schema::dropIfExists('chat_message');
    }
};
