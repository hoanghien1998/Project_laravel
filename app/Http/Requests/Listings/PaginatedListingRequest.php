<?php

namespace App\Http\Requests\Listings;

use App\Http\Requests\DataTable\DataTableRequest;

/**
 * Get Listing request.
 */
class PaginatedListingRequest extends DataTableRequest
{
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
