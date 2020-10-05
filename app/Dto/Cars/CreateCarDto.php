<?php

namespace App\Dto\Cars;

use Saritasa\Dto;

class CreateCarDto extends Dto
{
    public const PER_PAGE = 'per_page';
    public const PAGE = 'page';

    /**
     *
     * @var integer
     */
    public $per_page;

    /**
     *
     * @var integer
     */
    public $page;
}
