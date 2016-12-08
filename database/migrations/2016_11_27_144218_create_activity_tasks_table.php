<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityTasksTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activity_tasks', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->text('description');
			$table->integer('activity_id')->unsigned();
			$table->string('location');
			$table->datetime('start');
			$table->datetime('end');
			$table->datetime('inscription_start')->nullable();
			$table->datetime('inscription_end')->nullable();
			$table->integer('member_limit')->nullable();
			$table->boolean('is_mandatory')->default(0);
			$table->integer('points')->unsigned();
			$table->enum('inscription_policy', [
				'inscribed', 'all', 'board',
			])->default('inscribed');
			$table->timestamps();

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
		Schema::dropIfExists('activity_tasks');
	}
}
