<?php

namespace App\Http\Requests;

use App\Dto\Listings\CreateListingDto;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ListingRequest Listing cars request.
 *
 * @package App\Http\Requests
 */
class CreateListingRequest extends FormRequest
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
            CreateListingDto::CAR_TRIM_ID => 'required|int|min:1',
            CreateListingDto::YEAR => 'required|int|min:1900',
            CreateListingDto::PRICE => 'required|int',
            CreateListingDto::DESCRIPTION => 'string|max:1000000',
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
            CreateListingDto::CAR_TRIM_ID,
            CreateListingDto::YEAR,
            CreateListingDto::PRICE,
            CreateListingDto::DESCRIPTION,
        ]));
    }
}
