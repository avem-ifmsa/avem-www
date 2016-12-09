<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityTaskUserAllView extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('CREATE VIEW activity_task_user_all AS
			SELECT activity_task_id, user_id FROM activity_task_user
			UNION SELECT users.id AS user_id, activity_tasks.id AS activity_task_id FROM users
				CROSS JOIN activity_tasks WHERE activity_tasks.inscription_policy = "all"
			UNION SELECT mb_members.id AS user_id, activity_tasks.id AS activity_task_id FROM mb_members
				INNER JOIN mb_member_periods ON mb_members.id = mb_member_periods.mb_member_id
				CROSS JOIN activity_tasks WHERE activity_tasks.inscription_policy = "board" AND
					 ( activity_tasks.start    BETWEEN mb_member_periods.start AND mb_member_periods.end
					OR activity_tasks.end      BETWEEN mb_member_periods.start AND mb_member_periods.end
					OR mb_member_periods.start BETWEEN activity_tasks.start    AND activity_tasks.end
					OR mb_member_periods.end   BETWEEN activity_tasks.start    AND activity_tasks.end    )
		');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('DROP VIEW activity_task_user_all');
	}
}
