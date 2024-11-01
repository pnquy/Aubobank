<?php

// database/migrations/2024_09_30_000000_create_transaction_history_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionHistoryTable extends Migration
{
    public function up()
    {
        Schema::create('transaction_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Liên kết với bảng users
            $table->timestamp('transaction_time'); // Thời gian nạp tiền
            $table->string('content'); // Nội dung giao dịch
            $table->string('transaction_code'); // Mã giao dịch
            $table->decimal('amount', 15, 2); // Số tiền nạp
            $table->integer('spoint'); // Số SPOINT tương ứng
            $table->string('status'); // Trạng thái giao dịch
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaction_history');
    }
}

