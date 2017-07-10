<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActiveChargePeriodsView extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('
			CREATE VIEW active_charge_periods AS
				SELECT * FROM charge_periods
				INNER JOIN charges ON charge_id = charges.id
					WHERE charges.deleted_at IS NULL
					  AND CURRENT_TIMESTAMP BETWEEN start AND end
		');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('DROP VIEW active_charge_periods');
	}
}
