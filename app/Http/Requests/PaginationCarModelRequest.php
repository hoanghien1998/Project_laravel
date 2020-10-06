<?php

namespace App\Http\Requests;

use App\Dto\Cars\PaginateCarModels;

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
            PaginateCarModels::PER_PAGE => 'integer|min:1',
            PaginateCarModels::PAGE => 'integer|min:1',
            PaginateCarModels::MAKE_ID => 'integer|min:1',

        ];
    }

    /**
     * Returns car models data from request.
     *
     * @return PaginateCarModels
     */
    public function getPaginateCarModels(): PaginateCarModels
    {
        $param = $this->only([
            PaginateCarModels::PER_PAGE,
            PaginateCarModels::PAGE,
            PaginateCarModels::MAKE_ID,
        ]);
        $param[PaginateCarModels::PER_PAGE] = $param[PaginateCarModels::PER_PAGE] ?? 30;
        $param[PaginateCarModels::PAGE] = $param[PaginateCarModels::PAGE] ?? 1;
        $param[PaginateCarModels::MAKE_ID] = $param[PaginateCarModels::MAKE_ID] ?? 241;

        return new PaginateCarModels($param);
    }
}
