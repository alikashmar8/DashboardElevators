<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as faker;


use Illuminate\Database\Seeder;

class BuildingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create random 20 buildings
        $faker = Faker::create();
        for ($i = 0; $i < 20; $i++) {
            DB::table('buildings')->insert([
                'name' => $faker->name,
                'address' => $faker->address,
                'floors' => rand(1, 30),
                'contactNumber' => $faker->phoneNumber,
            ]);
        }

    }
}
