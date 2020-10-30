<?php

namespace App\Http\Requests\Listings;

use Saritasa\Transformers\DtoModel;

/**
 * Class ListingFilter
 *
 * @package App\Http\Requests\Listings
 */
class ListingFilter extends DtoModel
{
    public const MAKE_ID = 'make_id';
    public const MODEL_ID = 'model_id';
    public const TRIM_ID = 'trim_id';
    public const YEAR_START = 'year_start';
    public const YEAR_END = 'year_end';

    /**
     * Listing make id separated by comma.
     *
     * @var integer
     */
    public $make_id;

    /**
     * Listing model id separated by comma.
     *
     * @var integer
     */
    public $model_id;

    /**
     * Listing trim id separated by comma.
     *
     * @var integer
     */
    public $trim_id;

    /**
     * Listing year start
     *
     * @var integer
     */
    public $year_start;

    /**
     * Listing year end.
     *
     * @var integer
     */
    public $year_end;
}
