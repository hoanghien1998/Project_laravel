<?php

namespace App\Dto\Cars;

use App\Dto\Cars\PaginateInfo;

class PaginateCarModelsDto extends PaginateInfo
{
    public const MAKE_ID = 'make_id';

    /**
     * Cars make id in table car_models
     *
     * @var integer
     */
    public $make_id;
}
