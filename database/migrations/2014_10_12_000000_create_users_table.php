<?php

use App\Domains\Auth\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(uuid())'));
            $table->string('email')->unique()->nullable(false);
            $table->string('phone_number')->unique()->nullable(false);
            $table->string('password')->nullable(false);
            $table->string('first_name')->nullable(false);
            $table->string('last_name')->nullable(false);
            $table->integer('scoint')->default(0)->nullable(false);
            $table->string('address')->nullable();
            $table->string('company')->nullable();
            $table->text('avatar')->nullable();

            $table->boolean('is_locked')->default(false)->nullable(false);
            $table->integer('login_attempts')->default(0)->nullable(false);

            $table->boolean('otp_verify_login_pause')->default(true)->nullable(false);
            $table->boolean('telegram_notification_pause')->default(true)->nullable(false);
            $table->string('telegram_token')->nullable();
            $table->uuid('telegram_group_id')->nullable();
            $table->text('access_token')->nullable();


            $table->timestamps();



            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('password_changed_at')->nullable();
            $table->unsignedTinyInteger('active')->default(1);
            $table->string('timezone')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->boolean('to_be_logged_out')->default(false);
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->rememberToken();
            $table->softDeletes();
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
}