<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerformedActivitiesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('performed_activities', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('activity_id')->unsigned();
			$table->integer('charge_period_id')->unsigned();
			$table->timestamps();

			$table->foreign('user_id')
			      ->references('id')->on('users')
			      ->onDelete('cascade');

			$table->foreign('activity_id')
			      ->references('id')->on('activities')
			      ->onDelete('cascade');

			$table->foreign('charge_period_id')
			      ->references('id')->on('charge_periods')
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
		Schema::dropIfExists('performed_activities');
	}
}
