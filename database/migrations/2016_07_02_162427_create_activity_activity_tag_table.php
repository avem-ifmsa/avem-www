<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityActivityTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_activity_tag', function (Blueprint $table) {
            $table->integer('activity_id')->unsigned();
            $table->integer('activity_tag_id')->unsigned();
            $table->timestamps();

            $table->primary(['activity_id', 'activity_tag_id']);
            $table->foreign('activity_id')
                  ->references('id')->on('activities')
                  ->onDelete('cascade');
            $table->foreign('activity_tag_id')
                  ->references('id')->on('activity_tags')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('activity_activity_tag');
    }
}
