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
        Schema::create('ticket_create_store', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user')->unsigned();
            $table->bigInteger('id_store')->unsigned();
            $table->string('message')->nullable();
            $table->enum('status', [0,1,2])->comment('0 là đang xử lí, 1 là đã duyệt, 2 là bị từ chối')->default(0);
            $table->timestamps();
        });
        Schema::table('ticket_create_store', function ($table) {
            $table->foreign('id_user')->references('id')->on('users');
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
        Schema::dropIfExists('ticket_create_store');
    }
};
