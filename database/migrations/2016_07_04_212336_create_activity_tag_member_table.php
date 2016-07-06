<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityTagMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_tag_member', function (Blueprint $table) {
            $table->integer('activity_tag_id')->unsigned();
            $table->integer('member_id')->unsigned();
            $table->timestamps();

            $table->primary(['activity_tag_id', 'member_id']);
            $table->foreign('activity_tag_id')
                  ->references('id')->on('activity_tags')
                  ->onDelete('cascade');
            $table->foreign('member_id')
                  ->references('id')->on('members')
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
        Schema::drop('activity_tag_member');
    }
}
