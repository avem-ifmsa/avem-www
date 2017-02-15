<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActiveMbMembersView extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('CREATE VIEW active_mb_members AS
			SELECT mb_members.* FROM mb_members INNER JOIN mb_member_periods ON mb_member_periods.mb_member_id = mb_members.id
			WHERE CURRENT_TIMESTAMP BETWEEN mb_member_periods.start AND mb_member_periods.end
			GROUP BY mb_members.id LIMIT 1
		');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('DROP VIEW active_mb_members');
	}
}
