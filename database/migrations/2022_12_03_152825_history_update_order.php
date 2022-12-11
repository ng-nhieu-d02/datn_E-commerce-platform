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
        Schema::create('history_update_order', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_order')->unsigned();
            $table->string('create_by');
            $table->string('content');
            $table->timestamps();
        });
        Schema::table('history_update_order', function ($table) {
<<<<<<< HEAD
            $table->foreign('id_order')->nullable()->references('id')->on('order');
=======
            $table->foreign('id_order')->references('id')->on('order');
>>>>>>> fdca0204e789172b5dcf9f662990e355b44886f3
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_update_order');
    }
};
