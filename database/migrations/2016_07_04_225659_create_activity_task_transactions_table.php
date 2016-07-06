<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityTaskTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_task_transactions', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->integer('activity_task_id')->unsigned();
            $table->timestamps();

            $table->foreign('id')
                  ->references('id')->on('points_transactions')
                  ->onDelete('cascade');
            $table->foreign('activity_task_id')
                  ->references('id')->on('activity_tasks')
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
        Schema::drop('activity_task_transactions');
    }
}
