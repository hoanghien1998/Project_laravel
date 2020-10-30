<?php

namespace App\Repositories;

use App\Dto\Listings\CreateListingDto;
use App\Models\CarModel;
use App\Models\CarTrim;
use App\Models\Listing;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Saritasa\LaravelRepositories\Exceptions\RepositoryException;
use Saritasa\LaravelRepositories\Repositories\Repository;

/**
 * Listing model repository. Manages stored entities.
 */
class ListingsRepository extends Repository
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
     * @param int|null $model_id model_id
     * @param int|null $make_id make_id
     * @param int|null $trim_id trim id
     * @param int|null $year_start year start
     * @param int|null $year_end year end
     *
     * @return LengthAwarePaginator
     */
    public function getAllListings(int $perpage, ?int $model_id, ?int $make_id, ?int $trim_id, ?int $year_start, ?int $year_end): LengthAwarePaginator
    {
        if ($trim_id==null && $model_id == null && $make_id == null && $year_start == null && $year_end == null) {
            return Listing::paginate($perpage);
        } else {
            $relations = new Listing();
            if (!empty($make_id) && empty($model_id) && empty($trim_id)) {
                $car_models = CarModel::where('make_id', $make_id);
                if ($car_models->count()>0) {
                    $car_models = $car_models->get();
                    $car_trims =CarTrim::where('model_id');
                    if ($car_trims->count()>0) {
                        $car_trims = $car_trims->get();
                    }
                }
                if ($car_models->count()>0) {
                    $car_model_ids = [];
                    foreach ($car_models as $car_model) {
                        $car_model_ids[]=$car_model->id;
                    }
                    $relations = $relations->whereIn('car_model_id', $car_model_ids);
                }
                if ($car_trims->count()>0) {
                    $car_trim_ids = [];
                    foreach ($car_trims as $car_trim) {
                        $car_trim_ids[]=$car_trim->id;
                    }
                    $relations = $relations->whereIn('car_trim_id', $car_trim_ids);
                }
            }
            if (!empty($model_id)) {
                $relations = $relations->where('car_model_id', $model_id);
            }
            if (!empty($trim_id)) {
                $relations = $relations->where('car_trim_id', $trim_id);
            }

        }

        return  $relations->paginate($perpage);
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

    /**
     * Update status approve or not
     *
     * @param int $id Id of the listing
     *
     * @return mixed
     */
    public function approveListing(int $id)
    {
        $approve = Listing::where('id', $id)->first()->approve;

        Listing::where('id', $id)
            ->update([
                'approve' => ! $approve,
            ]);

        return Listing::where('id', $id)->get();
    }
}
