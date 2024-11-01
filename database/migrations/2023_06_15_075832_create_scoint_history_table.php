<?php

use App\Models\ScointHistory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateScointHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scoint_historys', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(uuid())'));
            $table->string('transaction_id')->nullable();
            $table->uuid('user_id')->nullable();
            $table->enum('action', ScointHistory::ACTIONS)->nullable(false);
            $table->enum('status', ScointHistory::STATUSES)->nullable(false);

            $table->integer('amount')->nullable(false);
            $table->string('content')->nullable();
            $table->uuid('package_id')->nullable();
            $table->uuid('other_user_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('set null');
            $table->foreign('other_user_id')->references('id')->on('users')->onDelete('set null');
        });

        DB::statement('ALTER TABLE scoint_historys ADD CHECK (amount >= 0)');
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scoint_historys');
    }
}
