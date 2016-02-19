<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UsersTableSeeder::class);
        $this->call(TargetgroupSeeder::class);
        $this->call(TargetSeeder::class);
        $this->call(ReservationSeeder::class);

        $me = User::findOrFail(1);
        $me->targetgroup_id = 1;
        $me->save();

        Model::reguard();
    }
}
