<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$me = new User(array(
	        'name' => 'Jussi',
	        'email' => 'jussi@nollaversio.fi',
	        'password' => bcrypt('52300r'),
	        'remember_token' => str_random(10),
    	));
    	//$me->targetgroup_id = 1;
    	$me->save();
        factory('App\User', 20)->create();


    }
}
