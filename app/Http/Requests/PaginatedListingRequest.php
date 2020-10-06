<?php

namespace App\Http\Requests;

use App\Dto\Listings\PaginatedListingDto;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PaginatedListingRequest Validate paginated listing request
 *
 * @package App\Http\Requests
 */
class PaginatedListingRequest extends FormRequest
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
     * @return int[]
     */
    public function rules(): array
    {
        return [
            PaginatedListingDto::PER_PAGE => 'int|min:1',
            PaginatedListingDto::PAGE => 'int|min:1',
            PaginatedListingDto::MAKE_ID => 'int|min:1',
            PaginatedListingDto::MODEL_ID => 'int|min:1',
        ];
    }

    /**
     * Returns listing data from request.
     *
     * @return PaginatedListingDto
     */
    public function getPaginateListingDto(): PaginatedListingDto
    {
        $param = $this->only([
            PaginatedListingDto::PER_PAGE,
            PaginatedListingDto::PAGE,
            PaginatedListingDto::MAKE_ID,
            PaginatedListingDto::MODEL_ID,
        ]);
        $param[PaginatedListingDto::PER_PAGE] = $param[PaginatedListingDto::PER_PAGE] ?? 30;
        $param[PaginatedListingDto::PAGE] = $param[PaginatedListingDto::PAGE] ?? 1;
        $param[PaginatedListingDto::MAKE_ID] = $param[PaginatedListingDto::MAKE_ID] ?? 241;
        $param[PaginatedListingDto::MODEL_ID] = $param[PaginatedListingDto::MODEL_ID] ?? 15;

        return new PaginatedListingDto($param);
    }
}
