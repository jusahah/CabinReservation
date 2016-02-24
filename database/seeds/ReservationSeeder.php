<?php

use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory('App\Reservation', 10)->create();
    	return;
        $res = [
	        'user_id' => 1,
	        'original_user_id' => 1,
	        'target_id' => rand(1,6),
	        'startdate' => $faker->dateTimeThisMonth(),
	        'enddate' => $faker->dateTimeThisMonth(),
	        'notes' => $faker->paragraph
    	];
    }
}
