<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSimplePointsTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simple_points_transactions', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->string('concept');
            $table->timestamps();

            $table->foreign('id')
                  ->references('id')->on('points_transactions')
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
        Schema::drop('simple_points_transactions');
    }
}
