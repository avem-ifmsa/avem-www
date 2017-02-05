<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaimResolutionsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('claim_resolutions', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('claim_id')->unsigned();
			$table->integer('mb_member_period_id')->unsigned();
			$table->enum('status', [ 'accepted', 'declined' ]);
			$table->timestamps();

			$table->foreign('claim_id')
			      ->references('id')->on('claims')
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
		Schema::dropIfExists('claim_resolutions');
	}
}
