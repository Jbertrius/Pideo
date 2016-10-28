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
        $table->foreign('user_id')->references('id')
            ->on('users')  
            ->onDelete('cascade')
            ->onUpdate('restrict');

        $table->integer('post_id')->unsigned();
        $table->foreign('post_id')->references('id')
            ->on('post')  
            ->onDelete('cascade')
            ->onUpdate('restrict');

        $table->integer('cat_id')->unsigned();
        $table->foreign('cat_id')->references('id')
            ->on('subjects') 
            ->onDelete('cascade')
            ->onUpdate('restrict');

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
