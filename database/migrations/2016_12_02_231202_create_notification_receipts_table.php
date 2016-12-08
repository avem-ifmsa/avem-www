<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationReceiptsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notification_receipts', function (Blueprint $table) {
			$table->integer('notification_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->timestamp('read_at')->nullable();
			$table->timestamps();

			$table->primary(['notification_id', 'user_id']);
			$table->foreign('notification_id')
			      ->references('id')->on('notifications')
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
		Schema::dropIfExists('notification_receipts');
	}
}
