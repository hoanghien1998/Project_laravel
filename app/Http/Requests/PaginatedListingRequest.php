<?php

namespace App\Http\Requests;

use App\Dto\Listings\PaginatedListingDto;
use Illuminate\Foundation\Http\FormRequest;

class PaginatedListingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            PaginatedListingDto::PER_PAGE => 'required|int|min:1',
            PaginatedListingDto::PAGE => 'required|int|min:1',
            PaginatedListingDto::MAKE_ID => 'required|int|min:1',
            PaginatedListingDto::MODEL_ID => 'required|int|min:1',
        ];
    }

    /**
     * Returns listing data from request.
     *
     * @return CreateListingDto
     */
    public function getCreateListingDto(): CreateListingDto
    {
        return new CreateListingDto($this->only([
            PaginatedListingDto::PER_PAGE,
            PaginatedListingDto::PAGE,
            PaginatedListingDto::MAKE_ID,
            PaginatedListingDto::MODEL_ID,
        ]));
    }
}
