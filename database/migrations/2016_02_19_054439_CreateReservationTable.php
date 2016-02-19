<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('original_user_id')->unsigned();
            $table->integer('target_id')->unsigned();
            $table->date('startdate');
            $table->date('enddate'); // Implicit constraint: Must be later than startdate
            $table->string('notes', 512);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // If user is deleted, we don't want to cascade as some other user may already own this reservation
            // So no cascade onDelete of original user
            
            $table->foreign('original_user_id')->references('id')->on('users');
            $table->foreign('target_id')->references('id')->on('targets')->onDelete('cascade');
            $table->index('user_id');
            $table->index('original_user_id');
            $table->index('target_id');            
            
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reservations');

    }
}
