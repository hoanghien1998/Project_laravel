<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use App\Repositories\RolesRepository;
use App\Repositories\UsersRepository;
use Illuminate\Database\Eloquent\Model;
use Saritasa\LaravelRepositories\Contracts\IRepository;
use Saritasa\LaravelRepositories\Contracts\IRepositoryFactory;
use Throwable;

/**
 * Users business-get-profile service.
 */
class UsersService
{
    /**
     * User repository
     *
     * @var IRepository
     */
    private $repository;

    /**
     * Role repository
     *
     * @var RolesRepository
     */
    private $rolesRepository;

    /**
     * Get user profile
     *
     * @var UsersRepository
     */
    private $getUserRepository;

    /**
     * Users business-logic service.
     *
     * @param IRepositoryFactory $repositoryFactory Service factory
     * @param RolesRepository $rolesRepository Roles records storage abstraction
     * @param UsersRepository $getUserRepository Profile user
     *
     * @throws Throwable
     */
    public function __construct(
        IRepositoryFactory $repositoryFactory,
        RolesRepository $rolesRepository,
        UsersRepository $getUserRepository
    ) {
        $this->repository = $repositoryFactory->getRepository(User::class);
        $this->rolesRepository = $rolesRepository;

        $this->repository = $repositoryFactory->getRepository(User::class);
        $this->getUserRepository = $getUserRepository;
    }


    /**
     * Get profile user.
     *
     * @param int $id user is
     *
     * @return mixed
     */
    public function getProfile(int $id)
    {
        $user = $this->getUserRepository->getUser($id);
        return $user;
    }


    /**
     * Get role user by id.
     *
     * @param int $id user id
     *
     * @return Role|Model
     */
    public function getRole(int $id)
    {
        $role = $this->rolesRepository->findById($id);
        return $role;
    }
}
