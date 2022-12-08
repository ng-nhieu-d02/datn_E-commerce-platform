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
        Schema::create('store', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('avatar')->default('avatar-default-store.png');
            $table->string('background')->default('background-default-store.png');
            $table->string('slogan')->default('Nguyễn Xuân Nhiều - Dev v5.0');
            $table->bigInteger('money')->default(0);
            $table->string('address');
            $table->string('district');
            $table->string('city');
            $table->integer('prestige')->comment('uy tín +1 mỗi khi đơn hàng dc xử lí thành công')->default(0);
            $table->enum('status',[0,1,2])->comment('0 là đang kiểm duyệt, 1 là bình thường, 2 là bị khoá')->default(0);
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
        Schema::dropIfExists('store');
    }
};
