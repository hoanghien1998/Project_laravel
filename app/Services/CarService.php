<?php

namespace App\Services;

use App\Http\Requests\Cars\CarModelFilter;
use App\Http\Requests\Cars\CarTrimFilter;
use App\Models\CarMake;
use App\Repositories\CarsMakeRepository;
use App\Repositories\CarsModelRepository;
use App\Repositories\CarsTrimRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Saritasa\DingoApi\Paging\PagingInfo;
use Saritasa\LaravelRepositories\Contracts\IRepository;

/**
 * Class CarService business-logic service
 *
 * @package App\Services
 */
class CarService
{
    /**
     * Cars repository
     *
     * @var IRepository
     */
    private $repository;

    /**
     * Role repository car makes
     *
     * @var CarsMakeRepository
     */
    private $carsMakeRepository;

    /**
     * Role repository cars model
     *
     * @var CarsModelRepository
     */
    private $carsModelRepository;

    /**
     * Role repository cars trim
     *
     * @var CarsTrimRepository
     */
    private $carsTrimRepository;

    /**
     * CarService constructor.
     *
     * @param CarsMakeRepository $carsMakeRepository cars make repository
     * @param CarsModelRepository $carsModelRepository cars model repository
     * @param CarsTrimRepository $carsTrimRepository cars trim repository
     */
    public function __construct(
        CarsMakeRepository $carsMakeRepository,
        CarsModelRepository $carsModelRepository,
        CarsTrimRepository $carsTrimRepository
    ) {
        $this->carsMakeRepository = $carsMakeRepository;
        $this->carsModelRepository = $carsModelRepository;
        $this->carsTrimRepository= $carsTrimRepository;
    }

    /**
     * Get all list carMakes
     *
     * @param PagingInfo $pagingInfo param per page and page
     *
     * @return CarMake|CarMake[]|Collection
     */
    public function carMakes(PagingInfo $pagingInfo)
    {
        return $this->carsMakeRepository->getAllCarMakes($pagingInfo->pageSize);
    }

    /**
     * Get all list carModels
     *
     * @param PagingInfo $pagingInfo param per page and page
     * @param CarModelFilter $carModelFilter filter param make id
     *
     * @return LengthAwarePaginator
     */
    public function carModels(PagingInfo $pagingInfo, CarModelFilter $carModelFilter): LengthAwarePaginator
    {
        $per_page = $pagingInfo->pageSize;
        $make_id = $carModelFilter->make_id;
        return $this->carsModelRepository->getAllCarModels($per_page, $make_id);
    }

    /**
     * Get all list carTrims
     *
     * @param PagingInfo $pagingInfo param per page and page
     * @param CarTrimFilter $carTrimFilter filter param model id
     *
     * @return LengthAwarePaginator
     */
    public function carTrims(PagingInfo $pagingInfo, CarTrimFilter $carTrimFilter): LengthAwarePaginator
    {
        $per_page = $pagingInfo->pageSize;
        $model_id = $carTrimFilter->model_id;
        return $this->carsTrimRepository->getAllCarTrims($per_page, $model_id);
    }
}
