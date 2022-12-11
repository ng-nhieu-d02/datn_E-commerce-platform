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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('name');
            $table->bigInteger('money')->unsigned()->default(0);
            $table->enum('gender',['man', 'women', 'other'])->default('man');
            $table->string('avatar')->default('avatar-default.png');
            $table->string('background')->default('background-default.jpg');
            $table->string('token')->nullable();
            $table->enum('permission',[0,1])->comment('0 là user, 1 là admin')->default(0);
            $table->integer('prestige')->comment('uy tín +1 mỗi khi đơn hàng dc xử lí thành công')->default(0);
            $table->integer('turns')->default(0);
            $table->string('address')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->enum('status',[0,1,2,3,4])->comment('0 là chưa xác thực, 1 là đã xác thực sdt, 2 là đã xác thực email, 3 là đã xác thực cả 2, 4 là bị khoá')->default(0);
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
        Schema::dropIfExists('users');
    }
};
