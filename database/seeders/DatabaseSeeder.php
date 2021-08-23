<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\Payment;
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
        // \App\Models\User::factory(10)->create();
//        Country::factory(10)->create();
//        City::factory(10)->create();
        Payment::factory(10)->create();

    }
}
