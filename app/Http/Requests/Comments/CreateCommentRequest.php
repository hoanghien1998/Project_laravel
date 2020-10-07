<?php

namespace App\Http\Requests\Comments;

use App\Dto\Comments\CreateCommentDto;
use Illuminate\Foundation\Http\FormRequest;

class CreateCommentRequest extends FormRequest
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
            CreateCommentDto::OBJECT_NAME => 'required|in:listing,comment',
            CreateCommentDto::OBJECT_ID => 'required',
            CreateCommentDto::MESSAGE => 'required',
        ];
    }

    /**
     * Returns comment data from request.
     *
     * @return CreateCommentDto
     */
    public function getCreateCommentDto(): CreateCommentDto
    {
        return new CreateCommentDto($this->only([
            CreateCommentDto::OBJECT_NAME,
            CreateCommentDto::OBJECT_ID,
            CreateCommentDto::MESSAGE,
        ]));
    }
}
