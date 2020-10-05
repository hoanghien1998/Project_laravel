<?php

namespace App\Http\Requests;

use App\Dto\Cars\CreateCarDto;

/**
 * Class PaginationCarMakeRequest
 * @package App\Http\Requests
 */
class PaginationCarMakeRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return mixed[]
     */
    public function rules(): array
    {
        return [
            CreateCarDto::PER_PAGE => 'required|integer|min:1',
            CreateCarDto::PAGE => 'required|integer|min:1',

        ];
    }

    /**
     * Returns user and profile data from request.
     *
     * @return CreateCarDto
     */
    public function getCreateCarDto(): CreateCarDto
    {
        return new CreateCarDto($this->only([
            CreateCarDto::PER_PAGE,
            CreateCarDto::PAGE,

        ]));
    }

}
