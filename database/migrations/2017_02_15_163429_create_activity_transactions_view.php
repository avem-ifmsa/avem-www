<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityTransactionsView extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// TODO: testing
		DB::statement('CREATE VIEW activity_transactions AS
			SELECT user_id, id AS activity_task_id FROM performed_tasks
			INNER JOIN activity_tasks ON activity_task_id = activity_tasks.id
			INNER JOIN activities ON actities.id = activity_tasks.activity_id
				WHERE NOT EXISTS (
					SELECT * FROM performed_tasks
					LEFT JOIN activity_tasks ON activity_task_id = activity_tasks.id
						WHERE activity_tasks.activity_id = activities.id AND is_mandatory = 1
				)
		');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('DROP VIEW activity_transactions');
	}
}
