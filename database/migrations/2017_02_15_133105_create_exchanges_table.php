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
			$table->text('reports')->default('');
			$table->string('lc_nmo')->nullable();
			$table->integer('vacancies')->unsigned();
			$table->text('observations')->nullable();
			$table->text('requirements')->default('');
			$table->boolean('published')->default(true);
			$table->integer('destination_id')->unsigned();
			$table->integer('mb_member_period_id')->unsigned();
			$table->enum('modality', ['clinical', 'research'])->required();
			$table->timestamps();

			$table->foreign('destination_id')
			      ->references('id')->on('destinations')
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
		Schema::dropIfExists('exchanges');
	}
}
