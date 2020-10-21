<?php

namespace App\Http\Requests\Comments;

use App\Http\Requests\DataTable\DataTableRequest;

/**
 * Class PaginatedCommentRequest Validate paginated comment request
 *
 * @package App\Http\Requests\Comments
 */
class PaginatedCommentRequest extends DataTableRequest
{
    /**
     * PaginatedCommentRequest validate.
     *
     * @param mixed[] $rules Validation rules
     *
     * @return mixed[]
     */
    public function rules(array $rules = []): array
    {
        return parent::rules(array_merge([
            CommentFilter::OBJECT_NAME => 'required|in:listing,comment',
        ], $rules));
    }
    /**
     * Get Comment object name filters.
     *
     * @return CommentFilter
     */
    public function getCommentFilters(): CommentFilter
    {
        return new CommentFilter($this->only([CommentFilter::OBJECT_NAME]));
    }
}
