<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\PaginationCarMakeRequest;
use App\Http\Transformers\CarsTransformer;
use App\Services\CarService;
use Dingo\Api\Http\Response;
use Illuminate\Http\Request;
use Saritasa\LaravelControllers\Api\BaseApiController;


/**
 * Class CarController
 * @package App\Http\Controllers\Api\v1
 */
class CarController extends BaseApiController
{
    /**
     * Cars business-logic service.
     * @var CarService
     */
    private $carService;

    /**
     * CarController constructor.
     * @param CarService $carService Cars business-logic service.
     */
    public function __construct(CarService $carService)
    {
        parent::__construct();
        $this->carService = $carService;
    }

    /**
     * get all list cars makes
     *
     * @param PaginationCarMakeRequest $request
     * @return Response
     */
    public function carMakes(PaginationCarMakeRequest $request): Response
    {
        $carMakes = $this->carService->carMakes($request->getCreateCarDto());
        return $this->response->paginator($carMakes, new CarsTransformer());
    }
}
