<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\CreateListingRequest;
use App\Http\Requests\PaginatedListingRequest;
use App\Http\Transformers\ListingTransformer;
use App\Services\ListingService;
use Illuminate\Http\Request;
use Saritasa\LaravelControllers\Api\BaseApiController;

/**
 * Class ListingController Listing information of cars controller.
 * @package App\Http\Controllers\Api\v1
 */
class ListingController extends BaseApiController
{
    /**
     * Listing business-logic service.
     *
     * @var ListingService
     */
    private $listingService;

    /**
     * ListingController constructor.
     * @param ListingService $listingService Listing business-logic service.
     */
    public function __construct(ListingService $listingService) {
        parent::__construct();
        $this->listingService = $listingService;
    }

    public function createListing(CreateListingRequest $request): Response
    {
        $listing = $this->listingService->listings($request->getCreateListingDto());

        return $this->json($listing);
    }

    public function paginatedListing()
    {
        $listing = $this->listingService->paginatedListing();
        return $this->response->paginator($listing, new ListingTransformer);
    }

}
