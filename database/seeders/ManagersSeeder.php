<?php

namespace Database\Seeders;

use Faker\Factory as faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManagersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 1; $i < 10; $i++) {
            DB::table('managers')->insert([
                'name' => $faker->name,
                'address' => $faker->address,
                'profilePicture' => 'noImage.jpg',
                'phoneNumber' => $faker->phoneNumber,
            ]);
        }
    }
}
