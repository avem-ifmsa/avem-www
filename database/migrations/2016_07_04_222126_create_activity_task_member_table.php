<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityTaskMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_task_member', function (Blueprint $table) {
            $table->integer('activity_task_id')->unsigned();
            $table->integer('member_id')->unsigned();
            $table->timestamps();

            $table->primary(['activity_task_id', 'member_id']);
            $table->foreign('activity_task_id')
                  ->references('id')->on('activity_tasks')
                  ->onDelete('cascade');
            $table->foreign('member_id')
                  ->references('id')->on('member_id')
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
        Schema::drop('activity_task_member');
    }
}
