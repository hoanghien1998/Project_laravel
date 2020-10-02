<?php

namespace App\Dto\Listings;

use Saritasa\Dto;

/**
 * Class CreateListingDto Data transfer object with user profile information.
 * @package App\Dto\Listings
 * @property int $per_page
 * @property int $page
 * @property int $make_id
 * @property int $model_id
 */
class PaginatedListingDto extends Dto
{
    public const PER_PAGE = 'per_page';
    public const PAGE = 'page';
    public const MAKE_ID = 'make_id';
    public const MODEL_ID = 'model_id';

    /**
     * Listing per page.
     *
     * @var int
     */
    public $per_page;

    /**
     * Listing page.
     *
     * @var int
     */
    public $page;

    /**
     * Listing make id.
     *
     * @var int
     */
    public $make_id;

    /**
     * Listing model id.
     *
     * @var int
     */
    public $model_id;

}
