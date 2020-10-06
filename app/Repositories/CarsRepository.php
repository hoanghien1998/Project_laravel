<?php

namespace App\Repositories;

use App\Models\CarMake;
use App\Models\CarModel;
use Saritasa\LaravelRepositories\Exceptions\RepositoryException;
use Saritasa\LaravelRepositories\Repositories\Repository;

/**
 * Cars model repository. Manages stored entities.
 */
class CarsRepository extends Repository
{
    /**
     * RolesRepository constructor.
     *
     * @throws RepositoryException
     */
    public function __construct()
    {
        parent::__construct(CarMake::class);
        parent::__construct(CarModel::class);
    }

    /**
     * Get all carMakes pagination
     *
     * @param $per_page
     *
     * @return CarMake[]|Collection
     */
    public function getAllCarMakes($per_page)
    {
        return CarMake::paginate($per_page);
    }

    /**
     * Get all carModels pagination
     *
     * @param $per_page
     *
     * @return CarModel[]|Collection
     */
    public function getAllCarModels($per_page)
    {
        return CarModel::paginate($per_page);
    }
}
