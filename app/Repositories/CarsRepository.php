<?php

namespace App\Repositories;

use App\Models\CarMake;
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
    }

    /**
     * Get all carMakes
     *
     * @param $per_page
     *
     * @return CarMake
     */
    public function getAllCarMakes($per_page)
    {
        return CarMake::paginate($per_page);
    }
}
