<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityUserAllView extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('CREATE VIEW activity_user_all AS
			SELECT activity_id, user_id FROM activity_user
			UNION SELECT users.id AS user_id, activities.id AS activity_id FROM users
				CROSS JOIN activities WHERE activities.inscription_policy = "all"
			UNION SELECT mb_members.id AS user_id, activities.id AS activity_id FROM mb_members
				INNER JOIN mb_member_periods ON mb_members.id = mb_member_periods.mb_member_id
				CROSS JOIN activities WHERE activities.inscription_policy = "board" AND
					 ( activities.start        BETWEEN mb_member_periods.start AND mb_member_periods.end
					OR activities.end          BETWEEN mb_member_periods.start AND mb_member_periods.end
					OR mb_member_periods.start BETWEEN activities.start        AND activities.end
					OR mb_member_periods.end   BETWEEN activities.start        AND activities.end        )
		');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('DROP VIEW activity_user_all');
	}
}
