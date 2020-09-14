<?php

use App\Models\CarMake;
use App\Models\CarModel;
use Illuminate\Database\Seeder;

class CarModelSeeder extends Seeder
{
    public $number = 20;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carMakes = CarMake::get();
        foreach ($carMakes as $carMake) {
            factory(CarModel::class, $this->number)->create([
                CarModel::MAKE_ID => $carMake->id,
            ]);
        }
    }
}
