<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityTicketsTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		Schema::create('activity_tickets', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('activity_id')->unsigned();
			$table->string('code', 6)->nullable()->unique();
			$table->integer('charge_period_id')->unsigned();
			$table->integer('performed_activity_id')->unsigned()->nullable();
			$table->timestamp('expires_at');
			$table->timestamps();

			$table->foreign('activity_id')
			      ->references('id')->on('activities')
			      ->onDelete('cascade');

			$table->foreign('charge_period_id')
			      ->references('id')->on('charge_periods')
			      ->onDelete('cascade');

			$table->foreign('performed_activity_id')
			      ->references('id')->on('performed_activities')
			      ->onDelete('set null');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('activity_tickets');
	}
}
