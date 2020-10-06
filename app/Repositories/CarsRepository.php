<?php

namespace App\Repositories;

use App\Models\CarMake;
use App\Models\CarModel;
use App\Models\CarTrim;
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
        parent::__construct(CarTrim::class);
    }

    /**
     * Get all carMakes pagination
     *
     * @param integer $per_page save param
     *
     * @return CarMake[]|Collection
     */
    public function getAllCarMakes(int $per_page)
    {
        return CarMake::paginate($per_page);
    }

    /**
     * Get all carModels pagination.
     *
     * @param integer $per_page save param
     *
     * @param integer $make_id get value from field in table car_models
     *
     * @return CarModel[]|Collection
     */
    public function getAllCarModels(int $per_page, int $make_id)
    {
        return CarModel::where('make_id', $make_id)->paginate($per_page);
    }

    /**
     * Get all carTrims pagination
     *
     * @param integer $per_page save param
     * @param integer $model_id get value param
     *
     * @return CarTrim[]|Collection
     */
    public function getAllCarTrims(int $per_page, int $model_id)
    {
        return CarTrim::where('model_id', $model_id)->paginate($per_page);
    }
}
