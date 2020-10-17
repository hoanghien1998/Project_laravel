<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Saritasa\LaravelRepositories\Exceptions\RepositoryException;
use Saritasa\LaravelRepositories\Repositories\Repository;

/**
 * Users roles records storage abstraction.
 */
class RolesRepository extends Repository
{
    /**
     * RolesRepository constructor.
     *
     * @throws RepositoryException
     */
    public function __construct()
    {
        parent::__construct(Role::class);
    }

    /**
     * Find role by id.
     *
     * @param string $id Role id
     *
     * @return Role|Model
     */
    public function findById(string $id)
    {
        return Role::where('id', $id)->first();
    }
}
