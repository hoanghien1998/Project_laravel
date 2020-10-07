<?php

namespace App\Http\Requests;

use App\Dto\Cars\PaginateCarDto;

/**
 * Class PaginationCarRequest
 *
 * @package App\Http\Requests
 */
class PaginationCarRequest extends Request
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
            PaginateCarDto::PER_PAGE => 'integer|min:1',
            PaginateCarDto::PAGE => 'integer|min:1',

        ];
    }

    /**
     * Returns car data from request.
     *
     * @return PaginateCarDto
     */
    public function getCreateCarDto(): PaginateCarDto
    {
        $param = $this->all([
            PaginateCarDto::PER_PAGE,
            PaginateCarDto::PAGE,
        ]);
        $param[PaginateCarDto::PER_PAGE] = $param[PaginateCarDto::PER_PAGE] ?? 30;
        $param[PaginateCarDto::PAGE] = $param[PaginateCarDto::PAGE] ?? 1;

        return new PaginateCarDto($param);
    }
}
