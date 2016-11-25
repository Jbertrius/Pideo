<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamp('created_at');
            $table->text('body');
            $table->text('type');
            $table->integer('conversation_id')->unsigned();
            $table->integer('post_id')->unsigned()->nullable();;
            
            $table->foreign('conversation_id')->references('id')->on('conversations')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            
            $table->integer('user_id')->unsigned();
            
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('restrict');

            $table->foreign('post_id')->references('id')->on('post')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function(Blueprint $table) {
            $table->dropForeign('messages_conversation_id_foreign');
        });

        Schema::table('messages', function(Blueprint $table) {
            $table->dropForeign('messages_post_id_foreign');
        });

        Schema::table('messages', function(Blueprint $table) {
            $table->dropForeign('messages_user_id_foreign');
        });
        
        Schema::drop('messages');
    }
}
