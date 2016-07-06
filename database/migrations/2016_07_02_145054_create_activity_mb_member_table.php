<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityMbMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_mb_member', function (Blueprint $table) {
            $table->integer('activity_id')->unsigned();
            $table->integer('mb_member_id')->unsigned();
            $table->timestamps();

            $table->primary(['activity_id', 'mb_member_id']);
            $table->foreign('activity_id')
                  ->references('id')->on('activities')
                  ->onDelete('cascade');
            $table->foreign('mb_member_id')
                  ->references('id')->on('mb_members')
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
        Schema::drop('activity_mb_member');
    }
}
