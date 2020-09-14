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
        $base_number = $this->number;
        $carMakes = CarMake::get();
        foreach ($carMakes as $carMake) {
            $this->number = $base_number;
            do {
                $carModelFactory = factory(CarModel::class);
                $carModelFactory->create([
                    CarModel::MAKE_ID => $carMake->id,
                ]);
                $this->number--;
            } while ($this->number > 0);
        }
    }
}
