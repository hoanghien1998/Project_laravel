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
     * @param integer $user_id user id
     * return Model
     *
     * @return Listing
     *
     * @throws RepositoryException
     */
    public function createListing(CreateListingDto $createListingDto, int $user_id): Listing
    {

        $data_tmp = $createListingDto->toArray();
        $modelId = $this->listingsRepository->getModelId($createListingDto->car_trim_id);
        $data = array_merge(
            $data_tmp,
            ['created_by' => $user_id],
            ['car_model_id' => $modelId]
        );

        return $this->repository->create(new Listing($data));
    }

    /**
     * Get listing pagination.
     *
     * @param PaginatedListingDto $paginatedListingDto Paginated listing dto
     *
     * @return Listing[]|Collection
     */
    public function paginatedListing(PaginatedListingDto $paginatedListingDto)
    {
        $per_page = $paginatedListingDto->per_page;
        $model_id = $paginatedListingDto->model_id;
        $make_id = $paginatedListingDto->make_id;

        return $this->listingsRepository->getAllListings($per_page, $model_id, $make_id);
    }

    /**
     * Get the specific listing.
     *
     * @param integer $id id of listing
     *
     * @return Listing
     */
    public function getListing(int $id): Listing
    {
        return $this->listingsRepository->getListing($id);
    }

    /**
     * Update the specific listing
     *
     * @param CreateListingDto $createListingDto provide value to update listing
     * @param integer $id listing_id
     *
     * @return Listing
     */
    public function updateListing(CreateListingDto $createListingDto, int $id): Listing
    {
        return $this->listingsRepository->updateListing($createListingDto, $id);
    }
}
