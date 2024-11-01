<?php

use App\Models\PaymentGateway;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePaymentGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('payment_gateways', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(uuid())'));
            $table->string('name')->unique()->nullable(false);
            $table->string('brand')->unique()->nullable(false);
            $table->string('logo')->nullable();
            $table->integer('sort_number')->default(0)->nullable(false);
            $table->enum('status', PaymentGateway::STATUSES)->nullable(false);
            $table->enum('type', PaymentGateway::TYPES)->nullable(false);
            $table->integer('flag')->nullable(false)->default(0);

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
        Schema::dropIfExists('payment_gateways');
    }
}
