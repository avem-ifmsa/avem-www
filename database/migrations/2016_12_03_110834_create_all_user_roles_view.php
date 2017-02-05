<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllUserRolesView extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('CREATE VIEW all_user_roles AS
			SELECT user_id, role_id FROM role_user
			UNION SELECT active_mb_members.id AS user_id, charge_role.role_id AS role_id FROM active_mb_members
				INNER JOIN mb_member_periods ON mb_member_periods.mb_member_id = active_mb_members.id
				INNER JOIN charge_roles ON charge_roles.charge_id = mb_member_periods.charge_id
		');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('DROP VIEW all_user_roles');
	}
}
