<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPasswordToMomoAccountsTable extends Migration
{
    public function up()
    {
        Schema::table('momo_accounts', function (Blueprint $table) {
            $table->string('password')->nullable(); // Thêm cột password, có thể để null nếu không cần thiết phải có
        });
    }

    public function down()
    {
        Schema::table('momo_accounts', function (Blueprint $table) {
            $table->dropColumn('password'); // Xóa cột password nếu rollback migration
        });
    }
}

