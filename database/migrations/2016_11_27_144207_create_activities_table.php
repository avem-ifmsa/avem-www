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
			$table->string('image')->nullable();
			$table->text('location')->nullable();
			$table->integer('points')->unsigned()->default(0);
			$table->integer('member_limit')->nullable();
			$table->datetime('start')->nullable();
			$table->datetime('end')->nullable();
			$table->datetime('inscription_start')->nullable();
			$table->datetime('inscription_end')->nullable();
			$table->enum('visibility', [ 'all', 'board', 'none' ]);
			$table->enum('inscription_policy', [ 'inscribed', 'all', 'board' ])
			      ->default('inscribed');
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
