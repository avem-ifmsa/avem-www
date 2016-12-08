<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityMbMemberPeriodTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activity_mb_member_period', function (Blueprint $table) {
			$table->integer('activity_id')->unsigned();
			$table->integer('mb_member_period_id')->unsigned();
			$table->timestamps();

			$table->primary(['activity_id', 'mb_member_period_id']);
			$table->foreign('activity_id')
			      ->references('id')->on('activities')
			      ->onDelete('cascade');
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
		Schema::dropIfExists('activity_mb_member_period');
	}
}
