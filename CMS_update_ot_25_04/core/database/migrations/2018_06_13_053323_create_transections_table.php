<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transections', function (Blueprint $table) {
            $table->increments('id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('gateway_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('user_balance')->nullable();
            $table->string('charge')->nullable();
            $table->tinyInteger('type')->nullable();
            $table->string('trx')->nullable();
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
        Schema::dropIfExists('transections');
    }
}
