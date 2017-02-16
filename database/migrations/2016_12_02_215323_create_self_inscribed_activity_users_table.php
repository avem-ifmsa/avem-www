<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSelfInscribedActivityUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('self_inscribed_activity_users', function (Blueprint $table) {
			$table->integer('activity_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->timestamps();

			$table->primary(['activity_id', 'user_id']);
			$table->foreign('activity_id')
			      ->references('id')->on('activities')
			      ->onDelete('cascade');
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
		Schema::dropIfExists('self_inscribed_activity_users');
	}
}
