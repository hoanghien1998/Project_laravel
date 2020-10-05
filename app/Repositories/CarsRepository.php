<?php

namespace App\Repositories;

use App\Models\CarMake;
use Illuminate\Database\Eloquent\Collection;
use Saritasa\LaravelRepositories\Exceptions\RepositoryException;
use Saritasa\LaravelRepositories\Repositories\Repository;

/**
 * Cars model repository. Manages stored entities.
 */
class CarsRepository extends Repository
{
    /**
     * RolesRepository constructor.
     * @throws RepositoryException
     */
    public function __construct()
    {
        parent::__construct(CarMake::class);
    }

    /**
     * Get all carMakes
     *
     * @return CarMake[]|Collection
     */
    public function getAllCarMakes()
    {
        return CarMake::paginate(15);
    }
}
