<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMbMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mb_members', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->string('dni_nif')->unique();
            $table->string('phone')->nullable();
            $table->timestamps();

            $table->foreign('id')
                  ->references('id')->on('members')
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
        Schema::drop('mb_members');
    }
}
