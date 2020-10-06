<?php

namespace App\Http\Requests;

use App\Dto\Cars\PaginationCarTrimsDto;

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
            PaginationCarTrimsDto::PER_PAGE => 'integer|min:1',
            PaginationCarTrimsDto::PAGE => 'integer|min:1',
            PaginationCarTrimsDto::MODEL_ID => 'integer|min:1',
        ];
    }

    /**
     * Returns car models data from request.
     *
     * @return PaginationCarTrimsDto
     */
    public function getPaginationCarTrims(): PaginationCarTrimsDto
    {
        $param = $this->only([
            PaginationCarTrimsDto::PER_PAGE,
            PaginationCarTrimsDto::PAGE,
            PaginationCarTrimsDto::MODEL_ID,
        ]);
        $param[PaginationCarTrimsDto::PER_PAGE] = $param[PaginationCarTrimsDto::PER_PAGE] ?? 30;
        $param[PaginationCarTrimsDto::PAGE] = $param[PaginationCarTrimsDto::PAGE] ?? 1;

        return new PaginationCarTrimsDto($param);
    }
}
