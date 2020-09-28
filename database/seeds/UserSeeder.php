<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public $number = 10000;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, $this->number)->create([
            User::ROLE_ID => 1,
            User::PWD_FIELD => '123456',
        ]);
    }
}
