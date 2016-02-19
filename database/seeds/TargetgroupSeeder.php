<?php

use Illuminate\Database\Seeder;

class TargetgroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Targetgroup', 8)->create();
    }
}
