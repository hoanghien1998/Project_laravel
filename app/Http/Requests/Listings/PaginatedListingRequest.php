<?php

namespace App\Http\Requests\Listings;

use App\Http\Requests\DataTable\DataTableRequest;

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
        return parent::rules(array_merge([
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
        return new ListingFilter($this->only([ListingFilter::MODEL_ID, ListingFilter::MAKE_ID]));
    }
}
