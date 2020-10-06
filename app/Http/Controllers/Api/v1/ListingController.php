<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\CreateListingRequest;
use App\Http\Requests\PaginatedListingRequest;
use App\Http\Transformers\ListingTransformer;
use App\Services\ListingService;
use Dingo\Api\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Saritasa\LaravelControllers\Api\BaseApiController;
use Saritasa\LaravelRepositories\Exceptions\RepositoryException;
use Tymon\JWTAuth\JWTAuth;

/**
 * Class ListingController Listing information of cars controller.
 *
 * @package App\Http\Controllers\Api\v1
 */
class ListingController extends BaseApiController
{
    /**
     * Jwt auth service.
     *
     * @var JWTAuth
     */
    protected $jwtAuth;

    /**
     * Listing business-logic service.
     *
     * @var ListingService
     */
    private $listingService;

    /**
     * ListingController constructor.
     *
     * @param ListingService $listingService Listing business-logic service.
     * @param JWTAuth $jwtAuth authentication
     */
    public function __construct(ListingService $listingService, JWTAuth $jwtAuth)
    {
        parent::__construct();
        $this->jwtAuth = $jwtAuth;
        $this->listingService = $listingService;
    }

    /**
     * Create new listing
     *
     * @param CreateListingRequest $request Validate form create
     *
     * @return Response
     *
     * @throws RepositoryException
     */
    public function createListing(CreateListingRequest $request): Response
    {
        $user_id = $this->jwtAuth->user()->id;

        $listing = $this->listingService->listings($request->getCreateListingDto(), $user_id);

        return $this->json($listing, new ListingTransformer());
    }

    /**
     * Get all listing pagination
     *
     * @param PaginatedListingRequest $request Validate params pagination
     *
     * @return Response
     */
    public function paginatedListing(PaginatedListingRequest $request): Response
    {
        $listings = $this->listingService->paginatedListing($request->getPaginateListingDto());
        return $this->response->paginator($listings, new ListingTransformer());
    }

    /**
     * Get the specific listing
     *
     * @param integer $id Id of listing
     *
     * @return Response|JsonResponse
     */
    public function getListing(int $id)
    {
        $validator = Validator::make(
            ['id' => $id],
            [
            'id' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $listing = $this->listingService->getListing($id);

        return $this->json($listing, new ListingTransformer());
    }

    /**
     * Update the specific listing
     *
     * @param integer $id Id of listing
     * @param CreateListingRequest $request Validate form update
     *
     * @return Response|JsonResponse
     */
    public function updateListing(int $id, CreateListingRequest $request)
    {
        $validator = Validator::make(
            ['id' => $id],
            [
            'id' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $updatedListing = $this->listingService->updateListing($request->getCreateListingDto(), $id);

        return $this->json($updatedListing, new ListingTransformer());
    }
}
