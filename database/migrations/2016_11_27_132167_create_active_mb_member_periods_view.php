<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActiveMbMemberPeriodsView extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('CREATE VIEW active_mb_member_periods AS
			SELECT * FROM mb_member_periods
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
		DB::statement('DROP VIEW active_mb_member_periods');
	}
}
