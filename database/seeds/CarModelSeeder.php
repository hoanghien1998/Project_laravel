<?php

use App\Models\CarMake;
use App\Models\CarModel;
use Illuminate\Database\Seeder;

class CarModelSeeder extends Seeder
{
    public $max_per_make = 30;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carMakes = CarMake::get();
        foreach ($carMakes as $carMake) {
            $number = rand(10, $this->max_per_make);

            factory(CarModel::class, $number)->create([
                CarModel::MAKE_ID => $carMake->id,
            ]);
        }
    }
}
