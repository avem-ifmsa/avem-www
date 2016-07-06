<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_tickets', function (Blueprint $table) {
            $table->integer('notification_id')->unsigned();
            $table->integer('member_id')->unsigned();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->primary(['member_id', 'notification_id']);
            $table->foreign('notification_id')
                  ->references('id')->on('notifications')
                  ->onDelete('cascade');
            $table->foreign('member_id')
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
        Schema::drop('notification_tickets');
    }
}
