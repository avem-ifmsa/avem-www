<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaggablesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('taggables', function (Blueprint $table) {
			$table->integer('tag_id')->unsigned();
			$table->morphs('taggable');
			$table->timestamps();

			$table->primary(['tag_id', 'taggable_id', 'taggable_type']);
			$table->foreign('tag_id')
			      ->references('id')->on('tags')
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
		Schema::dropIfExists('taggables');
	}
}
