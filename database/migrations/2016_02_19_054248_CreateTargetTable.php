<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('targets', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('targetgroup_id')->unsigned();
            $table->string('name', 64);
            $table->string('description', 1024);
            // Settings portion of the model
            $table->integer('maxReservationLength')->unsigned();
            $table->integer('minReservationLength')->unsigned();
            // Email settings
            $table->integer('emailWhenSomebodyReserves')->unsigned();
            $table->integer('emailWhenSomebodyCancels')->unsigned();
            $table->integer('emailWhenGeneralAnnouncement')->unsigned();
            // Can same user have two pending reservations at a same time?
            $table->boolean('allowTwoReservationsBySameUser');
            $table->timestamps();

            $table->foreign('targetgroup_id')->references('id')->on('targetgroups')->onDelete('cascade');
        });

        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('targets');
    }
}
