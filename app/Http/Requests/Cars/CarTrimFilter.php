<?php

namespace App\Http\Requests\Cars;

use Saritasa\Transformers\DtoModel;

/**
 * Class CarTrimFilter.
 *
 * @package App\Http\Requests\Cars
 */
class CarTrimFilter extends DtoModel
{
    public const MODEL_ID = 'model_id';

    /**
     * Car model id slugs separated by comma.
     *
     * @var integer
     */
    public $model_id;
}
