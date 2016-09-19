<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations_users', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('conversation_id')->unsigned();
            $table->foreign('conversation_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conversations_users', function(Blueprint $table) {
            $table->dropForeign('conversations_users_user_id_foreign');
        });

        Schema::table('conversations_users', function(Blueprint $table) {
            $table->dropForeign('conversations_users_conversation_id_foreign');
        });
        
        Schema::drop('conversations_users');
    }
}
