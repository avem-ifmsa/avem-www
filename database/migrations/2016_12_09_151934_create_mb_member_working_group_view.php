<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMbMemberWorkingGroupView extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('CREATE VIEW mb_member_working_group AS
			SELECT mb_member_id, working_group_id FROM charges
			INNER JOIN mb_member_periods ON mb_member_periods.charge_id = charges.id
		');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('DROP VIEW mb_member_working_group');
	}
}
