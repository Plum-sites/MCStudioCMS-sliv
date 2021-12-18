<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->nullable();
            $table->string('gateway_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('charge')->nullable();
            $table->string('usd_amo')->nullable();
            $table->string('btc_amo')->nullable();
            $table->string('btc_wallet');
            $table->string('trx')->default(0);
            $table->string('status')->default(0);
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
        Schema::dropIfExists('deposits');
    }
}
