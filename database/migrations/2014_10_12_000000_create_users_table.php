<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->rememberToken();

            // App specific stuff
            $table->integer('targetgroup_id')->unsigned()->nullable();
            $table->boolean('emailNotificationsOn');
            $table->timestamps();

            $table->foreign('targetgroup_id')->references('id')->on('targetgroups')->onDelete('cascade');
            $table->index('targetgroup_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
