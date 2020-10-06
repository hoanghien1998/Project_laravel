<?php

namespace App\Http\Requests;

use App\Dto\Cars\PaginateCarModelsDto;

/**
 * Class PaginationCarMakeRequest
 *
 * @package App\Http\Requests
 */
class PaginationCarModelRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return boolean
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return mixed[]
     */
    public function rules(): array
    {
        return [
            PaginateCarModelsDto::PER_PAGE => 'integer|min:1',
            PaginateCarModelsDto::PAGE => 'integer|min:1',
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
        $param = $this->only([
            PaginateCarModelsDto::PER_PAGE,
            PaginateCarModelsDto::PAGE,
            PaginateCarModelsDto::MAKE_ID,
        ]);
        $param[PaginateCarModelsDto::PER_PAGE] = $param[PaginateCarModelsDto::PER_PAGE] ?? 30;
        $param[PaginateCarModelsDto::PAGE] = $param[PaginateCarModelsDto::PAGE] ?? 1;

        return new PaginateCarModelsDto($param);
    }
}
