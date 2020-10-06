<?php

namespace App\Dto\Listings;

use Saritasa\Dto;

/**
 * Class CreateListingDto Data transfer object with user profile information.
 *
 * @package App\Dto\Listings
 *
 * @property int $car_trim_id
 * @property int $year
 * @property int $price
 * @property string $description
 */
class CreateListingDto extends Dto
{
    public const CAR_TRIM_ID = 'car_trim_id';
    public const YEAR = 'year';
    public const PRICE = 'price';
    public const DESCRIPTION = 'description';

    /**
     * Listing car trim id.
     *
     * @var int
     */
    public $car_trim_id;

    /**
     * Listing year.
     *
     * @var int
     */
    public $year;

    /**
     * Listing price.
     *
     * @var int
     */
    public $price;

    /**
     * Listing description.
     *
     * @var string
     */
    public $description;
}
