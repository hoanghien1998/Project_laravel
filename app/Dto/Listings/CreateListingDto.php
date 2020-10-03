<?php

namespace App\Dto\Listings;

use Saritasa\Dto;

/**
 * Class CreateListingDto Data transfer object with user profile information.
 *
 * @package App\Dto\Listings
 *
 * @property int $car_model_id
 * @property int $car_trim_id
 * @property int $year
 * @property int $price
 */
class CreateListingDto extends Dto
{
    public const CAR_MODEL_ID = 'car_model_id';
    public const CAR_TRIM_ID = 'car_trim_id';
    public const YEAR = 'year';
    public const PRICE = 'price';

    /**
     * Listing car model id.
     *
     * @var int
     */
    public $car_model_id;

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
}
