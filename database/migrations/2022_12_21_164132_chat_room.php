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
        Schema::create('chat_room', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_store')->unsigned();
            $table->bigInteger('id_user')->unsigned();
            $table->enum('status', [0,1,2])->comment('0 là bình thường, 1 là shop chặn, 2 là user chặn');
            $table->timestamps();
        });
        Schema::table('chat_room', function ($table) {
            $table->foreign('id_store')->references('id')->on('store');
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
        Schema::dropIfExists('chat_room');
    }
};
