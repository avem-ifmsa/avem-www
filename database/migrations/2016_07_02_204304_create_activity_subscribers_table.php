<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitySubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_subscribers', function (Blueprint $table) {
            $table->integer('member_id')->unsigned();
            $table->integer('activity_id')->unsigned();
            $table->timestamps();

            $table->primary(['member_id', 'activity_id']);
            $table->foreign('member_id')
                  ->references('id')->on('members')
                  ->onDelete('cascade');
            $table->foreign('activity_id')
                  ->references('id')->on('activities')
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
        Schema::drop('activity_subscribers');
    }
}
