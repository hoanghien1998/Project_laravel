<?php

namespace App\Http\Requests\Cars;

use App\Http\Requests\DataTable\DataTableRequest;

/**
 * Get car trim list request.
 */
class PaginationCarTrimRequest extends DataTableRequest
{
    /**
     * Get Car trim filters.
     *
     * @return CarTrimFilter
     */
    public function getCarTrimFilters(): CarTrimFilter
    {
        return new CarTrimFilter($this->only([CarTrimFilter::MODEL_ID]));
    }
}
