<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePideosTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pideo_tag', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('pideo_id')->unsigned();
            $table->integer('tag_id')->unsigned();
        });

        Schema::table('pideo_tag', function(Blueprint $table) {
            $table->foreign('pideo_id')->references('id')->on('pideos')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });

        Schema::table('pideo_tag', function(Blueprint $table) {
            $table->foreign('tag_id')->references('id')->on('tags')
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
        Schema::table('pideo_tag', function(Blueprint $table) {
            $table->dropForeign('pideo_tag_pideo_id_foreign');
        });

        Schema::table('pideo_tag', function(Blueprint $table) {
            $table->dropForeign('pideo_tag_tag_id_foreign');
        });

        Schema::drop('pideo_tag');
    }
}
