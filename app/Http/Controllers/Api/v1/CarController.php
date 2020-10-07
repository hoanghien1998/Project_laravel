<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Cars\PaginationCarMakeRequest;
use App\Http\Requests\Cars\PaginationCarModelRequest;
use App\Http\Requests\Cars\PaginationCarTrimRequest;
use App\Services\CarService;
use Dingo\Api\Http\Response;
use Saritasa\LaravelControllers\Api\BaseApiController;

/**
 * Class CarController
 *
 * @package App\Http\Controllers\Api\v1
 */
class CarController extends BaseApiController
{
    /**
     * Cars business-logic service.
     *
     * @var CarService
     */
    private $carService;

    /**
     * CarController constructor.
     *
     * @param CarService $carService Cars business-logic service.
     */
    public function __construct(CarService $carService)
    {
        parent::__construct();
        $this->carService = $carService;
    }

    /**
     * Get car make list.
     *
     * @param PaginationCarMakeRequest $request Car make list request
     *
     * @return Response
     */
    public function carMakes(PaginationCarMakeRequest $request): Response
    {
        return $this->json($this->carService->carMakes($request->getPagingInfo()));
    }

    /**
     * Get car model list.
     *
     * @param PaginationCarModelRequest $request Car model list request
     *
     * @return Response
     */

    public function carModels(PaginationCarModelRequest $request): Response
    {
        $list = $this->carService->carModels($request->getPagingInfo(), $request->getCarModelFilters());

        return $this->json($list);
    }

    /**
     * Get car trim list.
     *
     * @param PaginationCarTrimRequest $request Car trim list request
     *
     * @return Response
     */

    public function carTrims(PaginationCarTrimRequest $request): Response
    {
        $list = $this->carService->carTrims($request->getPagingInfo(), $request->getCarTrimFilters());

        return $this->json($list);
    }
}
