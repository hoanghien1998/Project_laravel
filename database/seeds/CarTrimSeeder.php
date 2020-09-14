<?php

use App\Models\CarMake;
use App\Models\CarModel;
use App\Models\CarTrim;
use Illuminate\Database\Seeder;

class CarTrimSeeder extends Seeder
{
    public $number = 10;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carModels = CarModel::get();
        foreach ($carModels as $carModel) {
            factory(CarTrim::class, $this->number)->create([
                CarTrim::MODEL_ID => $carModel->id,
            ]);
        }
    }
}
