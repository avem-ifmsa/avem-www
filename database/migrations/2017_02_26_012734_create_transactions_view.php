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
			SELECT concept, points, created_at, user_id, mb_member_period_id,
				"Avem\PlainTransaction" AS transactionable_type,
				id AS transactionable_id FROM plain_transactions
			UNION SELECT name AS concept, points, performed_activities.created_at,
				user_id, mb_member_period_id, "Avem\PerformedActivity" AS transactionable_type,
				performed_activities.id AS transactionable_id FROM performed_activities
					INNER JOIN activities ON activity_id = activities.id
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
