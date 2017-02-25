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
			$table->integer('activity_id')->unsigned();
			$table->integer('mb_member_period_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->timestamps();

			$table->foreign('mb_member_period_id')
			      ->references('id')->on('mb_member_periods')
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
