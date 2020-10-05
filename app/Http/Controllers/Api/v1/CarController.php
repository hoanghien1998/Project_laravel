<?php

namespace App\Http\Controllers\Api\v1;

use App\Services\CarService;
use Saritasa\LaravelControllers\Api\BaseApiController;
use Tymon\JWTAuth\JWTAuth;
use App\Models\CarMake;


class CarController extends BaseApiController
{
    /**
     * JWT Auth.
     *
     * @var JWTAuth
     */
    private $jwtAuth;

    /**
     * Cars business-logic service.
     * @var CarService
     */
    private $carService;

    /**
     * CarController constructor.
     * @param JWTAuth $jwtAuth
     * @param CarService $carService
     */
    public function __construct(
        JWTAuth $jwtAuth,
        CarService $carService
    ) {
        parent::__construct();
        $this->carService = $carService;
        $this->jwtAuth = $jwtAuth;
    }

    public function carMakes()
    {
        $carMake = CarMake::paginate(30);
        return $this->response->paginator($carMake, 200);
    }

}
