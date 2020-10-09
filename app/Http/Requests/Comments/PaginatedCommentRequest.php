<?php

namespace App\Http\Requests\Comments;

use App\Dto\Comments\PaginatedCommentDto;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PaginatedCommentRequest Validate paginated comment request
 *
 * @package App\Http\Requests\Comments
 */
class PaginatedCommentRequest extends FormRequest
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
            PaginatedCommentDto::PER_PAGE => 'int|min:1',
            PaginatedCommentDto::PAGE => 'int|min:1',
            PaginatedCommentDto::OBJECT_NAME => 'in:listing,comment',
        ];
    }

    /**
     * Returns comment data from request.
     *
     * @return PaginatedCommentDto
     */
    public function getPaginateCommentDto(): PaginatedCommentDto
    {
        $param = $this->only([
            PaginatedCommentDto::PER_PAGE,
            PaginatedCommentDto::PAGE,
            PaginatedCommentDto::OBJECT_NAME,
        ]);
        $param[PaginatedCommentDto::PER_PAGE] = $param[PaginatedCommentDto::PER_PAGE] ?? 30;
        $param[PaginatedCommentDto::PAGE] = $param[PaginatedCommentDto::PAGE] ?? 1;

        return new PaginatedCommentDto($param);
    }
}
