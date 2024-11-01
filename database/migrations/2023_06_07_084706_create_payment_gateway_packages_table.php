<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePaymentGatewayPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_gateway_packages', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(uuid())'));
            $table->uuid('payment_gateway_id')->nullable(false);
            $table->uuid('package_id')->nullable(false);
            $table->integer('usage_account_limit');
            $table->foreign('payment_gateway_id')->references('id')->on('payment_gateways');
            $table->foreign('package_id')->references('id')->on('packages');
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
        Schema::dropIfExists('payment_gateway_packages');
    }
}
