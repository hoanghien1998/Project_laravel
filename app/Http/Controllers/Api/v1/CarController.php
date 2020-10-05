<?php

namespace App\Http\Controllers\Api;

use App\Models\CarMake;


class CarController extends BaseApiController
{
    public function getCarMakes ()
    {
        $carMake = CarMake::paginate(30);
        return $this->response->paginator($carMake, 200);
    }

}
