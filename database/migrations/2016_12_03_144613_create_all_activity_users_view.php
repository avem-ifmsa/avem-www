<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllActivityUsersView extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('CREATE VIEW all_activity_users AS
			SELECT activity_id, user_id FROM activity_user
			UNION SELECT users.id AS user_id, activities.id AS activity_id FROM users
				CROSS JOIN activities WHERE activities.inscription_policy = "all"
			UNION SELECT active_mb_members.id, activities.id AS activity_id FROM active_mb_members
				CROSS JOIN activities WHERE activities.inscription_policy = "board"
		');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('DROP VIEW all_activity_users');
	}
}
