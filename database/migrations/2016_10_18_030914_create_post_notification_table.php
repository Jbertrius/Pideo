<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_notification', function(Blueprint $table) {
        $table->increments('id');

        $table->integer('user_id')->unsigned();
        $table->foreign('user_id')->references('id')->on('users');

        $table->integer('post_id')->unsigned();
        $table->foreign('post_id')->references('id')->on('post');

        $table->integer('cat_id')->unsigned();
        $table->foreign('cat_id')->references('id')->on('subjects');

        $table->boolean('read');
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
        //
    }
}
