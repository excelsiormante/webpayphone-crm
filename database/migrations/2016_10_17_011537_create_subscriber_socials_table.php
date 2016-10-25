<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriberSocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriber_socials', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('provider');
            $table->integer('provider_id');
            $table->string('token');
            $table->string('avatar');
            $table->integer('subscriber_id');
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
        Schema::drop('subscriber_socials');
    }
}
