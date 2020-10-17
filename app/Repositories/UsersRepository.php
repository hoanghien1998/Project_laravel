<?php

namespace App\Repositories;

use App\Models\User;
use Saritasa\LaravelRepositories\Exceptions\RepositoryException;
use Saritasa\LaravelRepositories\Repositories\Repository;

/**
 * User model repository. Manages stored entities.
 */
class UsersRepository extends Repository
{
    /**
     * RolesRepository constructor.
     *
     * @throws RepositoryException
     */
    public function __construct()
    {
        parent::__construct(User::class);
    }

    /**
     * Get user profile.
     *
     * @param int|null $id id user
     *
     * @return mixed
     */
    public function getUser(?int $id)
    {
        return User::where('id', $id)->first();
    }
}
