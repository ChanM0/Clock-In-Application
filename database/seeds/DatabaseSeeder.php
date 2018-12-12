<?php

use App\User;
use App\ClockIn;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // factory(User::class, 10)->create();
        factory(ClockIn::class, 10)->create();
    }
}
