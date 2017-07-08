<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExchangesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exchanges', function (Blueprint $table) {
			$table->increments('id');
			$table->text('conditions');
			$table->string('destination');
			$table->text('reports')->default('');
			$table->integer('vacancies')->unsigned();
			$table->text('observations')->nullable();
			$table->text('requirements')->default('');
			$table->boolean('published')->default(true);
			$table->integer('charge_period_id')->unsigned();
			$table->enum('type', ['national', 'international']);
			$table->enum('modality', ['clinical', 'research'])->required();
			$table->timestamps();
			
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
		Schema::dropIfExists('exchanges');
	}
}
