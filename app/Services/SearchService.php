<?php

namespace App\Services;

use App\Dto\Listings\SearchListingDto;
use App\Http\Requests\Listings\SearchListingRequest;
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
class SearchService
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
     * Get listing pagination.
     *
     * @param PagingInfo $pagingInfo param per page and page
     * @param SearchListingRequest $searchListingRequest
     * @return LengthAwarePaginator
     */
    public function searchListing(PagingInfo $pagingInfo, SearchListingRequest $searchListingRequest): LengthAwarePaginator
    {
//        $per_page = $pagingInfo->pageSize;
//        $model_id = $searchListingRequest->;
//        $make_id = $listingFilter->make_id;

//        return $this->listingsRepository->searchListings($per_page, $model_id, $make_id);
    }

}
