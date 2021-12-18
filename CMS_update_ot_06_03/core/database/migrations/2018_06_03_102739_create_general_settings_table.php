<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('base_color')->nullable();
            $table->string('product_charge')->default(0);
            $table->string('withdraw_charge')->default(0);
            $table->tinyInteger('reg')->nullable();
            $table->tinyInteger('email_verification')->nullable();
            $table->tinyInteger('email_notification')->nullable();
            $table->string('regular_des')->nullable();
            $table->string('e_sender')->nullable();
            $table->longText('e_message')->nullable();
            $table->string('banner_heading')->nullable();
            $table->text('banner_des')->nullable();
            $table->longText('about_us')->nullable();
            $table->text('service_des')->nullable();
            $table->text('testimonial_des')->nullable();
            $table->text('achivment_des')->nullable();
            $table->text('faq_des')->nullable();
            $table->longText('contact_address')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->text('footer_text')->nullable();
            $table->text('footer_heading')->nullable();
            $table->text('contact_des')->nullable();
            $table->text('api_des')->nullable();
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
        Schema::dropIfExists('general_settings');
    }
}
