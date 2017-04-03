<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityUserView extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('CREATE VIEW activity_user AS
			SELECT activity_id, user_id FROM self_inscribed_activity_users
				INNER JOIN activities ON activity_id = activities.id
				WHERE activities.inscription_policy = \'inscribed\'
			UNION SELECT users.id AS user_id, activities.id AS activity_id FROM users
				CROSS JOIN activities WHERE activities.inscription_policy = \'all\'
			UNION SELECT active_mb_member_periods.id, activities.id AS activity_id FROM active_mb_member_periods
				INNER JOIN mb_members ON active_mb_member_periods.mb_member_id = mb_members.id
				CROSS JOIN activities WHERE activities.inscription_policy = \'board\'
		');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('DROP VIEW activity_user');
	}
}
