<?php

namespace Database\Seeders;

use Faker\Factory as faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ElevatorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 1; $i < 40; $i++) {
            DB::table('elevators')->insert([
                'name' => $faker->sentence(2),
                'index' => rand(1, 30),
                'building_id' => rand(1, 20),
            ]);
        }
    }
}
