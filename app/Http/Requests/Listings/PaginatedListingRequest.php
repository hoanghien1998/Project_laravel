<?php

namespace App\Http\Requests\Listings;

use App\Http\Requests\DataTable\DataTableRequest;
use Carbon\Carbon;

/**
 * Get Listing request.
 */
class PaginatedListingRequest extends DataTableRequest
{
    /**
     * PaginatedListingRequest validate.
     *
     * @param mixed[] $rules Validation rules
     *
     * @return mixed[]
     */
    public function rules(array $rules = []): array
    {
        $year = Carbon::now()->year;

        return parent::rules(array_merge([
            ListingFilter::YEAR_START => 'nullable|numeric|min:1900|max:' . $year,
            ListingFilter::YEAR_END => 'nullable|numeric|min:1900|max:2020|gte:year_start',
            ListingFilter::MODEL_ID => 'int',
            ListingFilter::MAKE_ID => 'int',
        ], $rules));
    }

    /**
     * Get Listing model and make filters.
     *
     * @return ListingFilter
     */
    public function getListingFilters(): ListingFilter
    {
        return new ListingFilter($this->only([ListingFilter::MODEL_ID, ListingFilter::MAKE_ID,ListingFilter::TRIM_ID,ListingFilter::YEAR_START, ListingFilter::YEAR_END]));
    }
}
