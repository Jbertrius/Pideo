<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pideos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filename');
            $table->string('title'); 
            $table->integer('subject_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('restrict');

            $table->foreign('subject_id')
                ->references('id')
                ->on('subjects')
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
        Schema::table('pideos', function(Blueprint $table) {
            $table->dropForeign('pideos_user_id_foreign');
            $table->dropForeign('pideos_subject_id_foreign');
            $table->drop();
        });
    }
}
