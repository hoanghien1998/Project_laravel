<?php

namespace App\Services;

use App\Dto\Listings\CreateListingDto;
use App\Http\Requests\Listings\ListingFilter;
use App\Models\Listing;
use App\Repositories\ListingsRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Saritasa\DingoApi\Paging\PagingInfo;
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
            [Listing::CREATED_BY => $user_id],
            [Listing::CAR_MODEL_ID => $modelId]
        );

        return $this->repository->create(new Listing($data));
    }

    /**
     * Get listing pagination.
     *
     * @param PagingInfo $pagingInfo param per page and page
     * @param ListingFilter $listingFilter filter param make id and model id
     *
     * @return LengthAwarePaginator
     */
    public function paginatedListing(PagingInfo $pagingInfo, ListingFilter $listingFilter): LengthAwarePaginator
    {
        $per_page = $pagingInfo->pageSize;
        $model_id = $listingFilter->model_id;
        $make_id = $listingFilter->make_id;
        $trim_id = $listingFilter->trim_id;
        $year_start = $listingFilter->year_start;
        $year_end = $listingFilter->year_end;
        return $this->listingsRepository->getAllListings($per_page, $model_id, $make_id, $trim_id, $year_start, $year_end);
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
     */
    public function updateListing(CreateListingDto $createListingDto, int $id):Listing
    {
        return $this->listingsRepository->updateListing($createListingDto, $id);
    }

    /**
     * Update status approve or not
     *
     * @param int $id Id of the listing
     *
     * @return Listing
     */
    public function approveListing(int $id): Listing
    {
        return $this->listingsRepository->approveListing($id);
    }
}
