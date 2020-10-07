<?php

namespace App\Services;

use App\Http\Requests\Cars\CarModelFilter;
use App\Http\Requests\Cars\CarTrimFilter;
use App\Models\CarMake;
use App\Models\CarModel;
use App\Models\CarTrim;
use App\Repositories\CarsRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Saritasa\DingoApi\Paging\PagingInfo;
use Saritasa\LaravelRepositories\Contracts\IRepository;
use Saritasa\LaravelRepositories\Contracts\IRepositoryFactory;
use Saritasa\LaravelRepositories\Exceptions\RepositoryException;

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
     * Role repository
     *
     * @var CarsRepository
     */
    private $carsRepository;


    /**
     * CarService constructor.
     *
     * @param IRepositoryFactory $repositoryFactory Service factory
     * @param CarsRepository $carsRepository Service for cars
     *
     * @throws BindingResolutionException
     * @throws RepositoryException
     */
    public function __construct(IRepositoryFactory $repositoryFactory, CarsRepository $carsRepository)
    {
        $this->repository = $repositoryFactory->getRepository(CarMake::class);
        $this->repository = $repositoryFactory->getRepository(CarModel::class);
        $this->repository = $repositoryFactory->getRepository(CarTrim::class);
        $this->carsRepository = $carsRepository;
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
        return $this->carsRepository->getAllCarMakes($pagingInfo->pageSize);
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
        return $this->carsRepository->getAllCarModels($per_page, $make_id);
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
        return $this->carsRepository->getAllCarTrims($per_page, $model_id);
    }
}
