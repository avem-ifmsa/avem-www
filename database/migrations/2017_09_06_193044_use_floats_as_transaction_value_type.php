<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UseFloatsAsTransactionValueType extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('activities', function(Blueprint $table) {
			$table->float('points')->default(0)->change();
		});

		Schema::table('plain_transactions', function(Blueprint $table) {
			$table->float('points')->change();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('activities', function(Blueprint $table) {
			$table->integer('points')->unsigned()->default(0)->change();
		});

		Schema::table('plain_transactions', function(Blueprint $table) {
			$table->integer('points')->change();
		});
	}
}
