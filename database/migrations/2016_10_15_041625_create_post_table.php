<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->string('type');
            $table->integer('category')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('content');
            $table->integer('file_id')->unsigned()->nullable();
            $table->boolean('solved');
            $table->dateTime('created_at');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('category')
                ->references('id')
                ->on('subjects')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('file_id')
                ->references('id')
                ->on('fileentries')
                ->onDelete('restrict')
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
        //
    }
}
