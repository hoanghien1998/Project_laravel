<?php

namespace App\Http\Requests;

use App\Dto\Cars\PaginateCarMakeDto;

/**
 * Class PaginationCarMakeRequest
 *
 * @package App\Http\Requests
 */
class PaginationCarMakeRequest extends Request
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
            PaginateCarMakeDto::PER_PAGE => 'integer|min:1',
            PaginateCarMakeDto::PAGE => 'integer|min:1',

        ];
    }

    /**
     * Returns car makes data from request.
     *
     * @return PaginateCarMakeDto
     */
    public function getCreateCarDto(): PaginateCarMakeDto
    {
        $param = $this->only([
            PaginateCarMakeDto::PER_PAGE,
            PaginateCarMakeDto::PAGE,
        ]);
        $param[PaginateCarMakeDto::PER_PAGE] = $param[PaginateCarMakeDto::PER_PAGE] ?? 30;
        $param[PaginateCarMakeDto::PAGE] = $param[PaginateCarMakeDto::PAGE] ?? 1;

        return new PaginateCarMakeDto($param);
    }
}
