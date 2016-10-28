<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesNotifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages_notifications', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            
            $table->foreign('user_id')->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            
            $table->integer('message_id')->unsigned();
            
            $table->foreign('message_id')->references('id')
                ->on('messages')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            
            $table->integer('conversation_id')->unsigned();
            
            $table->foreign('conversation_id')->references('id')
                ->on('conversations')
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
        Schema::table('messages_notifications', function(Blueprint $table) {
            $table->dropForeign('messages_notifications_user_id_id_foreign');
        });

        Schema::table('messages_notifications', function(Blueprint $table) {
            $table->dropForeign('messages_notifications_message_id_foreign');
        });

        Schema::table('messages_notifications', function(Blueprint $table) {
            $table->dropForeign('messages_notifications_conversation_id_foreign');
        });

        Schema::drop('messages_notifications');
    }
}
