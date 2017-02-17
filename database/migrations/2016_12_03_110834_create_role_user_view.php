<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleUserView extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('CREATE VIEW role_user AS
			SELECT user_id, role_id FROM own_user_roles
			UNION SELECT mb_member_id AS user_id, role_id FROM active_mb_member_periods
				INNER JOIN charge_role USING (charge_id)
		');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('DROP VIEW role_user');
	}
}
