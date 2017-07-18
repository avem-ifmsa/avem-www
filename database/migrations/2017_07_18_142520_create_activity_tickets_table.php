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
			$table->string('code', 6);
			$table->integer('activity_id')->unsigned();
			$table->integer('charge_period_id')->unsigned();
			$table->integer('performed_activity_id')->unsigned()->nullable();
			$table->timestamps();

			$table->primary(['code', 'activity_id']);

			$table->foreign('activity_id')
			      ->references('id')->on('activities')
			      ->onDelete('cascade');
			
			$table->foreign('charge_period_id')
			      ->references('id')->on('charge_period')
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
