<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityChargePeriodTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activity_charge_period', function (Blueprint $table) {
			$table->integer('activity_id')->unsigned();
			$table->integer('charge_period_id')->unsigned();
			$table->timestamps();

			$table->primary(['activity_id', 'charge_period_id']);
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
		Schema::dropIfExists('activity_charge_period');
	}
}
