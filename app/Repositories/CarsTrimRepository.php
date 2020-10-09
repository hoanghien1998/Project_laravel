<?php

namespace App\Repositories;

use App\Models\CarTrim;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Saritasa\LaravelRepositories\Exceptions\RepositoryException;
use Saritasa\LaravelRepositories\Repositories\Repository;

class CarsTrimRepository extends Repository
{
    /**
     * RolesRepository constructor.
     *
     * @throws RepositoryException
     */
    public function __construct()
    {
        parent::__construct(CarTrim::class);
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
