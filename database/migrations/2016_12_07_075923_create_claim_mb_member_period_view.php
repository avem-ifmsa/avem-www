<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaimMbMemberPeriodView extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('CREATE VIEW claim_mb_member_period AS
			SELECT activity_mb_member_period.mb_member_period_id, claims.id AS claim_id FROM claims
				INNER JOIN activity_tasks ON activity_tasks.id = claims.activity_task_id
				INNER JOIN activity_mb_member_period ON activity_id
		');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('DROP VIEW claim_mb_member_period');
	}
}
