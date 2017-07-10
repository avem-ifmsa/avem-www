<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChargesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('charges', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->integer('index')->default(0);
			$table->text('description')->nullable();
			$table->string('ifmsa_name')->nullable();
			$table->string('ifmsa_acronym')->nullable();
			$table->integer('working_group_id')->unsigned()->nullable();
			$table->softDeletes();
			$table->timestamps();

			$table->foreign('working_group_id')
			      ->references('id')->on('working_groups')
			      ->onDelete('set null');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('charges');
	}
}
