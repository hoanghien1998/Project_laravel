<?php

namespace App\Http\Requests\Comments;

use Saritasa\Transformers\DtoModel;

/**
 * Class CommentFilter
 *
 * @package App\Http\Requests\Comments
 */
class CommentFilter extends DtoModel
{
    public const OBJECT_NAME = 'object_name';

    /**
     * Comment object model separated by comma.
     *
     * @var string
     */
    public $object_name;
}
