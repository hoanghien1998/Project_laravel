<?php

namespace App\Http\Requests\DataTable;

use Saritasa\Transformers\DtoModel;

/**
 * The model contains the sort order and the field to sort by.
 */
class SortOptionsData extends DtoModel
{
    public const ORDER_BY = 'orderBy';
    public const SORT_ORDER = 'sortOrder';

    /**
     * Snake attribute flag.
     *
     * @var bool
     */
    public static $snakeAttributes = false;


    /**
     * Field name to sort records by.
     *
     * @var string
     */
    public $orderBy;

    /**
     * Sort order (valid values: asc, desc).
     *
     * @var string
     */
    public $sortOrder;
}
