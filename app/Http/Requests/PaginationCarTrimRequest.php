<?php

namespace App\Http\Requests;

use App\Dto\Cars\PaginationCarTrims;

/**
 * Class PaginationCarMakeRequest
 *
 * @package App\Http\Requests
 */
class PaginationCarTrimRequest extends Request
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
            PaginationCarTrims::PER_PAGE => 'integer|min:1',
            PaginationCarTrims::PAGE => 'integer|min:1',
            PaginationCarTrims::MODEL_ID => 'integer|min:1',
        ];
    }

    /**
     * Returns car models data from request.
     *
     * @return PaginationCarTrims
     */
    public function getPaginationCarTrims(): PaginationCarTrims
    {
        $param = $this->only([
            PaginationCarTrims::PER_PAGE,
            PaginationCarTrims::PAGE,
            PaginationCarTrims::MODEL_ID,
        ]);
        $param[PaginationCarTrims::PER_PAGE] = $param[PaginationCarTrims::PER_PAGE] ?? 30;
        $param[PaginationCarTrims::PAGE] = $param[PaginationCarTrims::PAGE] ?? 1;
        $param[PaginationCarTrims::MODEL_ID] = $param[PaginationCarTrims::MODEL_ID] ?? 15;

        return new PaginationCarTrims($param);
    }
}
