<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChargePeriodsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('charge_periods', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('charge_id')->unsigned();
			$table->integer('user_id')->unsigned()->nullable();
			$table->dateTime('start');
			$table->dateTime('end');
			$table->timestamps();

			$table->foreign('user_id')
			      ->references('id')->on('users')
			      ->onDelete('cascade');
			
			$table->foreign('charge_id')
			      ->references('id')->on('charges')
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
		Schema::dropIfExists('charge_periods');
	}
}
