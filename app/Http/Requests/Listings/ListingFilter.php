<?php

namespace App\Http\Requests\Listings;

use Saritasa\Transformers\DtoModel;

/**
 * Class ListingFilter
 * @package App\Http\Requests\Listings
 */
class ListingFilter extends DtoModel
{
    public const MAKE_ID = 'make_id';
    public const MODEL_ID = 'model_id';

    /**
     * Listing model id separated by comma.
     *
     * @var integer
     */
    public $model_id;

    /**
     * Listing make id separated by comma.
     *
     * @var integer
     */
    public $make_id;
}
