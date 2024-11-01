<?php

// database/migrations/create_momo_accounts_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMomoAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('momo_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Khóa ngoại tới bảng users
            $table->string('account_name');
            $table->string('phone_number');
            $table->decimal('balance', 15, 2); // Số tiền
            $table->timestamp('added_at'); // Thời gian thêm tài khoản
            $table->timestamp('last_cron')->nullable(); // Thời gian chạy cron gần nhất
            $table->timestamps();

            // Thiết lập khóa ngoại
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('momo_accounts');
    }
}

