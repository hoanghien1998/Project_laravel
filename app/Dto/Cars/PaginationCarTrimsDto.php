<?php

namespace App\Dto\Cars;

class PaginationCarTrimsDto extends PaginateCarDto
{
    public const MODEL_ID = 'model_id';

    /**
     * Car model id in table car_trims
     *
     * @var integer
     */
    public $model_id;
}
