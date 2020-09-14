<?php

use App\Models\CarMake;
use Illuminate\Database\Seeder;
class CarMakeSeeder extends Seeder
{
    public $number = 100;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        do {
            $carMakeFactory = factory(CarMake::class);
            $carMakeFactory->create();
            $this->number--;
        } while ($this->number > 0);
    }
}
