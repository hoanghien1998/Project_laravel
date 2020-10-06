<?php

namespace App\Services;

use App\Dto\Cars\CreateCarDto;
use App\Dto\Cars\PaginateCarModels;
use App\Dto\Cars\PaginationCarTrims;
use App\Models\CarMake;
use App\Models\CarModel;
use App\Models\CarTrim;
use App\Repositories\CarsRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Collection;
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
     * @param CreateCarDto $createCarDto save param
     *
     * @return CarMake|CarMake[]|Collection
     */
    public function carMakes(CreateCarDto $createCarDto)
    {
        return $this->carsRepository->getAllCarMakes($createCarDto->per_page);
    }

    /**
     * Get all list carModels
     *
     * @param PaginateCarModels $paginateCarModels save param
     *
     * @return CarModel[]|Collection
     */
    public function carModels(PaginateCarModels $paginateCarModels)
    {
        return $this->carsRepository->getAllCarModels($paginateCarModels->per_page);
    }

    /**
     * Get all list carTrims
     *
     * @param PaginationCarTrims $paginationCarTrims save param
     *
     * @return CarTrim[]|Collection
     */
    public function carTrims(PaginationCarTrims $paginationCarTrims)
    {
        return $this->carsRepository->getAllCarTrims($paginationCarTrims->per_page);
    }
}
