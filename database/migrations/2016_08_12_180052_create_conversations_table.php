<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations', function(Blueprint $table) {
            $table->increments('id');
            $table->dateTime('created_at');
            $table->dateTime('update_at');
            $table->string('name');
            $table->integer('author_id')->unsigned();
            $table->foreign('author_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conversations', function(Blueprint $table) {
            $table->dropForeign('conversations_author_id_foreign');
        });
        
        Schema::drop('conversations');
    }
}
