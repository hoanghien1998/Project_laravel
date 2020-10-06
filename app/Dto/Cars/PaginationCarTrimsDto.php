<?php

namespace App\Dto\Cars;

use Saritasa\Dto;

class PaginationCarTrimsDto extends Dto
{
    public const PER_PAGE = 'per_page';
    public const PAGE = 'page';
    public const MODEL_ID = 'model_id';

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
     * Car model id in table car_trims
     *
     * @var integer
     */
    public $model_id;
}
