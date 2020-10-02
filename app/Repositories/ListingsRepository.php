<?php

namespace App\Repositories;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Collection;
use Saritasa\LaravelRepositories\Exceptions\RepositoryException;
use Saritasa\LaravelRepositories\Repositories\Repository;

/**
 * Listing model repository. Manages stored entities.
 */
class ListingsRepository extends Repository
{
    /**
     * RolesRepository constructor.
     * @throws RepositoryException
     */
    public function __construct()
    {
        parent::__construct(Listing::class);
    }

    /**
     * Get user by email or fail.
     *
     * @return Listing[]|Collection
     */
    public function getAllListings()
    {
        return Listing::paginate(15);
    }
}
