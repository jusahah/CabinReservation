<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('targetgroups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable(); // admin of the group
            $table->string('name', 64);
            $table->string('description', 1024);
            $table->boolean('allowTwoReservationsInsideGroupBySameUser');
            $table->timestamps();

            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Now that targetgroups is up we can add foreign key to users
        Schema::table('users', function(Blueprint $table) {
            //$table->foreign('targetgroup_id')->references('id')->on('targetgroups')->onDelete('cascade');
        });

        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('targetgroups');
    }
}
