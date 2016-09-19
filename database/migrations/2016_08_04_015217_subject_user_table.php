<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SubjectUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_user', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('subject_id')->unsigned();
            $table->integer('user_id')->unsigned();

        });

        Schema::table('subject_user', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });

        Schema::table('subject_user', function(Blueprint $table) {
            $table->foreign('subject_id')->references('id')->on('subjects')
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
        Schema::table('subject_user', function(Blueprint $table) {
            $table->dropForeign('subject_user_subject_id_foreign');
        });

        Schema::table('subject_user', function(Blueprint $table) {
            $table->dropForeign('subject_user_user_id_foreign');
        });

        Schema::drop('subject_user');
    }
}
