<?php

namespace App\Http\Requests;

use App\Dto\Cars\PaginateCarModelsDto;

/**
 * Class PaginationCarMakeRequest
 *
 * @package App\Http\Requests
 */
class PaginationCarModelRequest extends PaginationCarMakeRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return mixed[]
     */
    public function rules(): array
    {
        return [
            PaginateCarModelsDto::MAKE_ID => 'integer|min:1',
        ];
    }

    /**
     * Returns car models data from request.
     *
     * @return PaginateCarModelsDto
     */
    public function getPaginateCarModels(): PaginateCarModelsDto
    {
        $param = $this->all([
            PaginateCarModelsDto::MAKE_ID,
        ]);
        return new PaginateCarModelsDto($param);
    }
}
