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
     * @param int $perpage per_page
     *
     * @param int|null $model_id model_id
     * @param int|null $make_id make_id
     *
     * @return Listing[]|Collection
     */
    public function getAllListings(int $perpage, ?int $model_id, ?int $make_id)
    {
        if ($model_id == null && $make_id == null) {
            return Listing::paginate($perpage);
        }

        $relations = Listing::join("car_models", 'car_models.id', '=', 'listings.car_model_id');

        return $relations->orWhere(['car_model_id' => $model_id])
            ->orWhere(['make_id' => $make_id])
            ->select('listings.*', 'car_models.make_id')
            ->paginate($perpage);
    }

    /**
     * Get the specific listing
     *
     * @param int|null $id Id of listing
     *
     * @return mixed
     */
    public function getListing(?int $id)
    {
        return Listing::findOrFail($id);
    }

    /**
     * Update the specific listing
     *
     * @param CreateListingDto $createListingDto Create Listing Dto
     * @param int|null $id Id of listing
     *
     * @return mixed
     */
    public function updateListing(CreateListingDto $createListingDto, ?int $id)
    {
        Listing::where('id', $id)
            ->update([
                CreateListingDto::CAR_TRIM_ID => $createListingDto->car_trim_id,
                CreateListingDto::YEAR => $createListingDto->year,
                CreateListingDto::PRICE => $createListingDto->price,
                CreateListingDto::DESCRIPTION => $createListingDto->description,
                ]);

        return Listing::findOrFail($id);
    }

    /**
     * Get Model id between Listing and CarModel relationship
     *
     * @param int|null $car_trim_id Car trim id
     *
     * @return mixed
     */
    public function getModelId(?int $car_trim_id)
    {
        $article = Listing::where(["car_trim_id" => $car_trim_id])->with('carTrim')->first();
        return $article->carTrim->model_id;
    }
}
