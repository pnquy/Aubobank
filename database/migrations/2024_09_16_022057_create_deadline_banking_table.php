<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeadlineBankingTable extends Migration
{
    public function up()
    {
        Schema::create('deadline_banking', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->decimal('balance', 15, 2);
            $table->decimal('package_1', 15, 2)->nullable();
            $table->decimal('package_momo', 15, 2)->nullable();
            $table->decimal('package_vcb', 15, 2)->nullable();
            $table->decimal('package_bidv', 15, 2)->nullable();
            $table->decimal('package_mb', 15, 2)->nullable();
            $table->decimal('package_techcom', 15, 2)->nullable();
            $table->decimal('package_acb', 15, 2)->nullable();
            $table->decimal('package_zalopay', 15, 2)->nullable();
            $table->decimal('package_tp', 15, 2)->nullable();
            $table->decimal('package_tsr', 15, 2)->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('deadline_banking');
    }
}
