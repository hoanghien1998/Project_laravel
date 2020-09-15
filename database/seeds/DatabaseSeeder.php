<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(CarMakeSeeder::class);
        $this->call(CarModelSeeder::class);
        $this->call(CarTrimSeeder::class);
    }
}
