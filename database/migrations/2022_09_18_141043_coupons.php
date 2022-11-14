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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('create_by_user')->unsigned();
            // if boss coupons apply_store = 0
            $table->bigInteger('apply_store')->unsigned();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('avatar');
            $table->enum('type',[0,1,2])->comment('0 là giảm tiền, 1 giảm %, 2 là freeShip');
            $table->longText('message');
            $table->integer('money_apply_start');
            $table->integer('money_apply_end');
            
            // $table->timestamp('break_time');
            $table->integer('quantity');
            $table->integer('remaining_quantity');
            $table->timestamp('start_time')->nullable();
            $table->timestamp('stop_time')->nullable();
            $table->enum('coupon_type', [0,1])->comment('0 là sự kiện, 1 là chỉ những ai có code');
            $table->enum('apply_with', [0,1])->comment('0 là tất cả, 1 là người cụ thể');
            // nếu apply_with = 0 user_id = 0
            $table->bigInteger('user_id')->unsigned()->default(0);
            $table->enum('status',[0,1])->comment('0 là bình thường, 1 là hết hạn')->default(0);
            $table->timestamps();
        });
        Schema::table('coupons', function ($table) {
            $table->foreign('create_by_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
};
