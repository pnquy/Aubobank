<?php

use App\Models\BankTransLog;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankTransLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_trans_logs', function (Blueprint $table) {
            $table->string('account_no')->nullable(false);
            $table->string('transaction_id')->nullable(false);
            $table->uuid('payment_gateway_id')->nullable(false);
            $table->decimal('amount', 10, 2)->nullable(false)->default(0);
            $table->string('description')->nullable(false);
            $table->dateTime('transaction_date')->nullable(false);
            $table->enum('type', BankTransLog::TYPES)->nullable(false);
            $table->decimal('balance', 65, 30)->nullable(false)->default(0);
            $table->json('object_data')->nullable();
            $table->timestamps();

            $table->primary(['account_no', 'payment_gateway_id', 'transaction_id'], 'pk_bank_trans_logs');
            $table->foreign('payment_gateway_id')->references('id')->on('payment_gateways');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_trans_logs');
    }
}
