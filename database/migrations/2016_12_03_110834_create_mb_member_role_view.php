<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMbMemberRoleView extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('CREATE VIEW mb_member_role AS
			SELECT DISTINCT mb_members.id AS mb_member_id, charge_role.role_id FROM mb_members
				INNER JOIN mb_member_periods ON mb_members.id=mb_member_periods.mb_member_id
				INNER JOIN charges ON mb_member_periods.charge_id=charges.id
				INNER JOIN charge_role ON charges.id=charge_role.charge_id
					WHERE CURRENT_TIMESTAMP BETWEEN mb_member_periods.start AND mb_member_periods.end
		');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('DROP VIEW mb_member_role');
	}
}