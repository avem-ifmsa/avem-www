<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaimsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('claims', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('activity_task_id')->unsigned();
			$table->text('info');
			$table->timestamps();

			$table->foreign('user_id')
			      ->references('id')->on('users')
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
		Schema::dropIfExists('claims');
	}
}
