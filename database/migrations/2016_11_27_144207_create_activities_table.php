<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activities', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->text('description');
			$table->string('location')->nullable();
			$table->datetime('start');
			$table->datetime('end');
			$table->datetime('inscription_start')->nullable();
			$table->datetime('inscription_end')->nullable();
			$table->integer('member_limit')->nullable();
			$table->string('image')->nullable();
			$table->enum('visibility', [
				'all', 'board', 'none',
			]);
			$table->enum('inscription_policy', [
				'inscribed', 'all', 'board',
			])->default('inscribed');
			$table->integer('points')->unsigned();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('activities');
	}
}
