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
     * @param array $rules
     *
     * @return array
     */
    public function rules(array $rules = []): array
    {
        return parent::rules([
            CommentFilter::OBJECT_NAME => 'required|in:listing,comment',
        ]);
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
