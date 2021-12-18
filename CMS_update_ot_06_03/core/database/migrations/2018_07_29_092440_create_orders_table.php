<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category_id');
            $table->string('service_id');
            $table->string('user_id');
            $table->string('service_no')->default(0);
            $table->string('order_no')->default(0);
            $table->string('link');
            $table->string('quantity');
            $table->string('price');
            $table->string('status')->default('Pending');
            $table->string('start_counter')->default(0);
            $table->string('remains')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
