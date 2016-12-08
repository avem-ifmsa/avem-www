<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityTaskUserTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activity_task_user', function (Blueprint $table) {
			$table->integer('activity_task_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->timestamps();

			$table->primary(['activity_task_id', 'user_id']);
			$table->foreign('activity_task_id')
			      ->references('id')->on('activity_tasks')
			      ->onDelete('cascade');
			$table->foreign('user_id')
			      ->references('id')->on('users')
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
		Schema::dropIfExists('activity_task_user');
	}
}
