<?php

namespace App\Dto\Listings;

use Saritasa\Dto;

/**
 * Data transfer object with user profile information.
 *
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string $gender
 */
class SearchListingDto extends Dto
{
    public const CAR_MODEL_ID = 'car_model_id';
    public const CAR_TRIM_ID = 'car_trim_id';
    public const YEAR = 'year';
    public const PRICE = 'price';

    /**
     * Listing car model id.
     *
     * @var string
     */
    public $car_model_id;

    /**
     * Listing car trim id.
     *
     * @var string
     */
    public $car_trim_id;

    /**
     * Listing year.
     *
     * @var string
     */
    public $year;

    /**
     * Listing price
     *
     * @var string
     */
    public $price;

}
