<?php

namespace App\Dto\Cars;

use Saritasa\Dto;

class PaginateCarModelsDto extends Dto
{
    public const PER_PAGE = 'per_page';
    public const PAGE = 'page';
    public const MAKE_ID = 'make_id';

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

    /**
     * Cars make id in table car_models
     *
     * @var integer
     */
    public $make_id;
}
