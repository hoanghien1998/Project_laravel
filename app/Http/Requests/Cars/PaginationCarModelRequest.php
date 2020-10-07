<?php

namespace App\Http\Requests\Cars;

use App\Http\Requests\DataTable\DataTableRequest;

/**
 * Get car model list request.
 */
class PaginationCarModelRequest extends DataTableRequest
{
    /**
     * Get Car model filters.
     *
     * @return CarModelFilter
     */
    public function getCarModelFilters(): CarModelFilter
    {
        return new CarModelFilter($this->only([CarModelFilter::MAKE_ID]));
    }
}
