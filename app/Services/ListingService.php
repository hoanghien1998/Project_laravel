<?php

namespace App\Services;

use App\Dto\Listings\CreateListingDto;
use App\Dto\Listings\PaginatedListingDto;
use App\Models\Listing;
use App\Repositories\ListingsRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Collection;
use Saritasa\LaravelRepositories\Contracts\IRepository;
use Saritasa\LaravelRepositories\Contracts\IRepositoryFactory;
use Saritasa\LaravelRepositories\Exceptions\RepositoryException;

/**
 * Listing business-logic service.
 */
class ListingService
{
    /**
     * Listing repository
     *
     * @var IRepository
     */
    private $repository;

    /**
     * Role repository
     *
     * @var ListingsRepository
     */
    private $listingsRepository;


    /**
     * ListingService constructor.
     * @param IRepositoryFactory $repositoryFactory Service factory
     * @param ListingsRepository $listingsRepository
     * @throws BindingResolutionException
     * @throws RepositoryException
     */
    public function __construct(IRepositoryFactory $repositoryFactory, ListingsRepository $listingsRepository)
    {
        $this->repository = $repositoryFactory->getRepository(Listing::class);
    }

    /**
     * Create user and fill user's profile.
     *
     * @param CreateListingDto $createListingDto
     * @return Listing
     *
     * @throws RepositoryException
     */
    public function listings(CreateListingDto $createListingDto): Listing
    {
        $data = $createListingDto->toArray();

        return $this->repository->create(new Listing($data));
    }

    /**
     * Create user and fill user's profile.
     *
     * @param PaginatedListingDto $paginatedListingDto
     * @return Listing[]|Collection
     *
     */
    public function paginatedListing()
    {
        return $this->listingsRepository->getAllListings();
    }
}
