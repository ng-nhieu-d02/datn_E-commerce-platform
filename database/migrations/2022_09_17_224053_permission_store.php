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
        Schema::create('permission_store', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_store')->unsigned();
            $table->bigInteger('id_user')->unsigned();
            $table->enum('permission', [0,1])->comment('0 là boss, 1 là cộng tác viên')->default(1);
            $table->timestamps();
        });
        Schema::table('permission_store', function ($table) {
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
        Schema::dropIfExists('permission_store');
    }
};
