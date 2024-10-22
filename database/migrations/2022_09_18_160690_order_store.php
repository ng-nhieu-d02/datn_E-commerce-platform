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
        Schema::create('order_store', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_order')->unsigned();
            $table->bigInteger('id_store')->unsigned();
            $table->bigInteger('id_coupons')->default(0);
            $table->integer('coupons_price')->default(0);
            $table->integer('total_price')->default(0);
            $table->integer('ship')->default(0);
            $table->integer('id_coupon_frs')->default(0);
            $table->integer('coupon_frs_price')->default(0);
            $table->string('message')->nullable();
            $table->enum('status_order',[0,1,2,3,4])->comment('0 là chờ xử lí, 1 là đã xác nhận - đang xử lí, 2 là đang giao hàng, 3 là thành công, 4 là thất bại')->default(0);
            $table->enum('status_payment_store', [0,1,2])->comment('0 là đang đợi xác nhận, 1 là đã thành toán, 2 là từ chối - giao dịch lỗi')->default(0);
            $table->timestamps();
        });
        Schema::table('order_store', function ($table) {
            $table->foreign('id_order')->references('id')->on('order');
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
        //
    }
};
