<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkingGroupsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('working_groups', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('color')->nullable();
			$table->integer('index')->default(0);
			$table->text('description')->nullable();
			$table->string('ifmsa_name')->nullable();
			$table->string('ifmsa_acronym')->nullable();
			$table->integer('parent_group_id')->unsigned()->nullable();
			$table->timestamps();

			$table->foreign('parent_group_id')
			      ->references('id')->on('working_groups')
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
		Schema::dropIfExists('working_groups');
	}
}
