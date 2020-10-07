<?php

namespace App\Dto\Comments;

use Saritasa\Dto;

/**
 * Class CreateCommentDto Data transfer object with comment information.
 *
 * @package App\Dto\Comments
 *
 * @property string $object_name
 * @property int $object_id
 * @property string $message
 */
class CreateCommentDto extends Dto
{
    public const OBJECT_NAME = 'object_name';
    public const OBJECT_ID = 'object_id';
    public const MESSAGE = 'message';

    /**
     * Comment object name.
     *
     * @var string
     */
    public $object_name;

    /**
     * Comment object id.
     *
     * @var int
     */
    public $object_id;

    /**
     * Comment message.
     *
     * @var string
     */
    public $message;
}
