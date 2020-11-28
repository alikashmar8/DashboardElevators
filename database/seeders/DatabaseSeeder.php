<?php

namespace Database\Seeders;

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
        $this->call([BuildingsSeeder::class,]);
        $this->call([ElevatorsSeeder::class,]);
        $this->call([ManagersSeeder::class,]);
        $this->call([ManagerBuildingRelationsSeeder::class,]);
    }
}
