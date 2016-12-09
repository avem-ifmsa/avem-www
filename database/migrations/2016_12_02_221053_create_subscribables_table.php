<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscribablesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subscribables', function (Blueprint $table) {
			$table->integer('user_id')->unsigned();
			$table->morphs('subscribable');
			$table->timestamps();

			$table->primary(['user_id', 'subscribable_id', 'subscribable_type']);
			$table->foreign('user_id')
			      ->references('id')->on('users')
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
		Schema::dropIfExists('subscribables');
	}
}
