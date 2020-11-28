<?php

namespace Database\Seeders;

use Faker\Factory as faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManagerBuildingRelationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 1; $i < 20; $i++) {
            DB::table('manager_building_relations')->insert([
                'manager_id' => rand(1, 10),
                'building_id' => rand(1, 20),
            ]);
        }
    }
}
