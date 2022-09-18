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
        Schema::create('basic_setting', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
            $table->string('icon');
            $table->string('logo');
            $table->string('keyword');
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->string('facebook');
            $table->string('zalo');
            $table->string('github');
            $table->string('instagram');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('basic_setting');
    }
};
