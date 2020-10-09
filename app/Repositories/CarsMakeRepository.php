<?php

namespace App\Repositories;

use App\Models\CarMake;
use Saritasa\LaravelRepositories\Exceptions\RepositoryException;
use Saritasa\LaravelRepositories\Repositories\Repository;

class CarsMakeRepository extends Repository
{
    /**
     * RolesRepository constructor.
     *
     * @throws RepositoryException
     */
    public function __construct()
    {
        parent::__construct(CarMake::class);
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
}
