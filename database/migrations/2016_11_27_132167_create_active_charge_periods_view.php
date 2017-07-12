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
				SELECT charge_periods.* FROM charge_periods
				INNER JOIN charges ON charge_id = charges.id
					WHERE charges.deleted_at IS NULL
					  AND charge_periods.start <= CURRENT_TIMESTAMP
					  AND CURRENT_TIMESTAMP < charge_periods.end
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