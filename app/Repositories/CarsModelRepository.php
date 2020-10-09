<?php

namespace App\Repositories;

use App\Models\CarModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Saritasa\LaravelRepositories\Exceptions\RepositoryException;
use Saritasa\LaravelRepositories\Repositories\Repository;

class CarsModelRepository extends Repository
{
    /**
     * RolesRepository constructor.
     *
     * @throws RepositoryException
     */
    public function __construct()
    {
        parent::__construct(CarModel::class);
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
}
