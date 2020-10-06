<?php

namespace App\Repositories;

use App\Dto\Listings\CreateListingDto;
use App\Models\Listing;
use Illuminate\Database\Eloquent\Collection;
use Saritasa\LaravelRepositories\Exceptions\RepositoryException;
use Saritasa\LaravelRepositories\Repositories\Repository;

/**
 * Listing model repository. Manages stored entities.
 */
class ListingsRepository extends Repository
{
    /**
     * RolesRepository constructor.
     *
     * @throws RepositoryException
     */
    public function __construct()
    {
        parent::__construct(Listing::class);
    }

    /**
     * Get listing pagination.
     *
     * @param integer $perpage per_page
     *
     * @return Listing[]|Collection
     */
    public function getAllListings(int $perpage)
    {
        return Listing::paginate($perpage);
    }

    /**
     * Get the specific listing
     *
     * @param integer $id Id of listing
     *
     * @return mixed
     */
    public function getListing(int $id)
    {
        return Listing::findOrFail($id);
    }

    /**
     * Update the specific listing
     *
     * @param CreateListingDto $createListingDto Create Listing Dto
     * @param integer $id Id of listing
     *
     * @return mixed
     */
    public function updateListing(CreateListingDto $createListingDto, int $id)
    {
        Listing::where('id', $id)
            ->update([
                CreateListingDto::CAR_MODEL_ID => $createListingDto->car_model_id,
                CreateListingDto::CAR_TRIM_ID => $createListingDto->car_trim_id,
                CreateListingDto::YEAR => $createListingDto->year,
                CreateListingDto::PRICE => $createListingDto->price,
                ]);

        return Listing::findOrFail($id);
    }
}
