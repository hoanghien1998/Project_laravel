<?php

namespace App\Dto\Cars;

use Saritasa\Dto;

/**
 * Class PaginateCarDto Data transfer object with car profile information
 *
 * @package App\Dto\Cars
 *
 * @property int $per_page
 * @property int $page
 */
class PaginateInfo extends Dto
{
    public const PER_PAGE = 'per_page';
    public const PAGE = 'page';

    /**
     * Cars per page
     *
     * @var integer
     */
    public $per_page;

    /**
     * Cars page
     *
     * @var integer
     */
    public $page;
}
