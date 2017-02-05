<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllSubscribablesView extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('CREATE VIEW all_subscribables AS
			SELECT user_id, subscribable_id, subscribable_type FROM subscribables
			UNION SELECT user_id, "App\Activity" AS subscribable_type,
			             activity_id AS subscribable_id FROM activity_user_all
		');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('DROP VIEW all_subscribables');
	}
}
