<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointsTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('points');
            $table->integer('member_id')->unsigned();
            $table->integer('applied_by')->unsigned();
            $table->timestamp('applied_at');
            $table->timestamps();

            $table->foreign('member_id')
                  ->references('id')->on('members')
                  ->onDelete('cascade');
            $table->foreign('applied_by')
                  ->references('id')->on('mb_members')
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
        Schema::drop('points_transactions');
    }
}
