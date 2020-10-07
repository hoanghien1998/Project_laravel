<?php

namespace App\Http\Requests\Cars;

use Saritasa\Transformers\DtoModel;

/**
 * Class CarModelFilter.
 *
 * @package App\Http\Requests\Cars
 */
class CarModelFilter extends DtoModel
{
    public const MAKE_ID = 'make_id';

    /**
     * Car id separated by comma.
     *
     * @var integer
     */
    public $make_id;
}
