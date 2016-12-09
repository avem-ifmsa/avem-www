<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transactions', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('mb_member_period_id')->unsigned();
			$table->morphs('transactionable');
			$table->timestamp('applied_at');
			$table->timestamps();

			$table->foreign('user_id')
			      ->references('id')->on('users')
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
		Schema::dropIfExists('transactions');
	}
}
