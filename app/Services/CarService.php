<?php

namespace App\Services;

use App\Models\CarMake;

/**
 * Class CarService business-logic service
 * @package App\Services
 */
class CarService
{
    public function carMakes()
    {
        $carMake = CarMake::paginate(30);
        return $this->response->paginator($carMake, 200);
    }

}
