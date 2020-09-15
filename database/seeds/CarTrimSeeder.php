<?php

use App\Models\CarModel;
use App\Models\CarTrim;
use Illuminate\Database\Seeder;

class CarTrimSeeder extends Seeder
{
    public $max_per_model = 20;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carModels = CarModel::get();

        foreach ($carModels as $idx => $carModel) {
            $number = rand(10, $this->max_per_model);

            do {
                $factory = factory(CarTrim::class);
                $factory->create([
                    CarTrim::MODEL_ID => $carModel->id,
                    CarTrim::NAME => $this->generateCarTrim($number),
                ]);
                $number--;
            } while($number > 0);
        }
    }

    /**
     *
     * @param $number
     */
    private function generateCarTrim($number)
    {
        $template = [
            "%s AT %s",
            "%s AT 4WD %s",
            "%s AT AWD Hybrid %s",
            "%s AT Hybrid %s",
            "%s MT %s",
            "%s MT GT %s",
            "%s MT Type V %s",
            "%s CVT %s",
            "%s CVT 4WD %s",
            "%s CVT AWD %s",
            "%s CTDi MT %s",
            "%s D AT AWD %s",
            "%s i-DTEC %s",
            "%s i-DTEC 4WD %s",
            "%s TDI %s",
            "%s TDI GT %s",
            "%s CTDi %s",
            "%s CTDi AT %s",
            "%s CTDi AT 4WD %s",
        ];

        $pattern = $template[$number % count($template)];
        if ($number < count($template)) {
            $opt = $number < 10 ? ["{$number}.0", ''] : [($number % 10) . "." . round($number / 10), ''];
        } else if ($number > count($template)) {
            $extra = $number < 100 ? 'Nr' : ($number < 1000 ? 'Sup' : 'VSup');
            $opt = [($number % 10) . "." . round($number / 10), $extra];
        } else {
            $opt = [$number, $number];
        }

        return sprintf($pattern, $opt[0], $opt[1] . $number);
    }
}
