<?php

namespace App\Dto\Comments;

use Saritasa\Dto;

/**
 * Class PaginatedCommentDto Data transfer object with get all comment pagination.
 *
 * @package App\Dto\Comments
 *
 * @property int $per_page
 * @property int $page
 * @property string $object_name
 */
class PaginatedCommentDto extends Dto
{
    public const PER_PAGE = 'per_page';
    public const PAGE = 'page';
    public const OBJECT_NAME = 'object_name';

    /**
     * Comment per page.
     *
     * @var int
     */
    public $per_page;

    /**
     * Comment page.
     *
     * @var int
     */
    public $page;

    /**
     * Listing object name.
     *
     * @var string
     */
    public $object_name;
}
