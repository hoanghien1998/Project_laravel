<?php

namespace App\Http\Requests;

use App\Dto\Cars\CreateCarDto;

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
            CreateCarDto::PER_PAGE => 'integer|min:1',
            CreateCarDto::PAGE => 'integer|min:1',

        ];
    }

    /**
     * Returns car makes data from request.
     *
     * @return CreateCarDto
     */
    public function getCreateCarDto(): CreateCarDto
    {
        $param = $this->only([
            CreateCarDto::PER_PAGE,
            CreateCarDto::PAGE,
        ]);
        $param[CreateCarDto::PER_PAGE] = $param[CreateCarDto::PER_PAGE] ?? 30;
        $param[CreateCarDto::PAGE] = $param[CreateCarDto::PAGE] ?? 1;

        return new CreateCarDto($param);
    }
}
