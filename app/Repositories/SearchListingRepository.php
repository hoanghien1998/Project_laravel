<?php

namespace App\Repositories;

use App\Dto\Listings\SearchListingDto;
use App\Models\CarModel;
use App\Models\Listing;
use App\Models\CarTrim;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Saritasa\LaravelRepositories\Exceptions\RepositoryException;
use Saritasa\LaravelRepositories\Repositories\Repository;

/**
 * Listing model repository. Manages stored entities.
 */
class SearchListingRepository extends Repository
{
    /**
     * ListingsRepository constructor.
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
     * @return LengthAwarePaginator
     */
    public function searchListings(int $perpage, ?int $model_id, ?int $make_id): LengthAwarePaginator
    {

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
