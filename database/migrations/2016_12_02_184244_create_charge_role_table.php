<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChargeRoleTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('charge_role', function (Blueprint $table) {
			$table->integer('charge_id')->unsigned();
			$table->integer('role_id')->unsigned();
			$table->timestamps();

			$table->primary(['charge_id', 'role_id']);
			$table->foreign('charge_id')
			      ->references('id')->on('charges')
			      ->onDelete('cascade');
			$table->foreign('role_id')
			      ->references('id')->on('roles')
			      ->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('charge_role');
	}
}
