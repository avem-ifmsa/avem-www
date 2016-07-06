<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMbMemberPeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mb_member_periods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mb_member_id')->unsigned();
            $table->integer('mb_charge_id')->unsigned();
            $table->dateTime('start');
            $table->dateTime('end');
            $table->timestamps();

            $table->foreign('mb_member_id')
                  ->references('id')->on('mb_members')
                  ->onDelete('cascade');
            $table->foreign('mb_charge_id')
                  ->references('id')->on('mb_charges')
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
        Schema::drop('mb_member_periods');
    }
}
