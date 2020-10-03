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
     *
     * @param IRepositoryFactory $repositoryFactory Service factory
     * @param ListingsRepository $listingsRepository listingsRepository
     *
     * @throws BindingResolutionException
     * @throws RepositoryException
     */
    public function __construct(IRepositoryFactory $repositoryFactory, ListingsRepository $listingsRepository)
    {
        $this->repository = $repositoryFactory->getRepository(Listing::class);
        $this->listingsRepository = $listingsRepository;
    }

    /**
     * Create user and fill user's profile.
     *
     * @param CreateListingDto $createListingDto Create listing dto
     *
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
     * @param PaginatedListingDto $paginatedListingDto Paginated listing dto
     *
     * @return Listing[]|Collection
     */
    public function paginatedListing(PaginatedListingDto $paginatedListingDto)
    {
        $per_page = $paginatedListingDto->per_page;
        return $this->listingsRepository->getAllListings($per_page);
    }
}
