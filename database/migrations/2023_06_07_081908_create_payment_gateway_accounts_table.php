<?php

use App\Models\PaymentGatewayAccount;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePaymentGatewayAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_gateway_accounts', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(uuid())'));


            $table->string('account_no')->nullable(false);
            $table->uuid('payment_gateway_id')->nullable(false);
            $table->uuid('user_id')->nullable(false);
            $table->uuid('user_package_id')->nullable();
            $table->string('password')->nullable(false);
            $table->text('token')->nullable();
            $table->boolean('pause')->default(false);
            $table->datetime('time_end')->nullable();
            $table->datetime('last_cron')->nullable();
            $table->json('account_data')->nullable();

            $table->enum('status', PaymentGatewayAccount::STATUSES)->nullable(false)->default(PaymentGatewayAccount::STATUSES['INIT']);
            // $table->integer('flag')->nullable(false)->default(0);


            $table->timestamps();

            $table->foreign('payment_gateway_id')->references('id')->on('payment_gateways');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('user_package_id')->references('id')->on('user_packages');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_gateway_accounts');
    }
}