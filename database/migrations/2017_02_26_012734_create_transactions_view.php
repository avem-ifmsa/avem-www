<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsView extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('CREATE VIEW transactions AS
			SELECT "Avem\PlainTransaction" AS transactionable_type,
			       id AS transactionable_id FROM plain_transactions
			UNION SELECT "Avem\PerformedActivity" AS transactionable_type,
			             id AS transactionable_id FROM performed_activities;
		');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('DROP VIEW transactions');
	}
}
