<?php

namespace App\Repositories;

use App\Models\CarMake;
use App\Models\CarModel;
use App\Models\CarTrim;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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
     * @param int|null $per_page save param
     *
     * @return CarMake[]|Collection
     */
    public function getAllCarMakes(?int $per_page)
    {
        return CarMake::paginate($per_page);
    }

    /**
     * Get all carModels pagination.
     *
     * @param int|null $per_page save param
     * @param int|null $make_id get value from field in table car_models
     *
     * @return LengthAwarePaginator
     */
    public function getAllCarModels(?int $per_page, ?int $make_id): LengthAwarePaginator
    {
        $builder = CarModel::query();
        if (!empty($make_id)) {
            $builder->where('make_id', $make_id);
        }
        return $builder->paginate($per_page);
    }

    /**
     * Get all carTrims pagination
     *
     * @param int|null $per_page save param
     * @param int|null $model_id get value param
     *
     * @return LengthAwarePaginator
     */
    public function getAllCarTrims(?int $per_page, ?int $model_id): LengthAwarePaginator
    {
        $builder = CarTrim::query();
        if (!empty($model_id)) {
            $builder->where('model_id', $model_id);
        }
        return $builder->paginate($per_page);
    }
}
