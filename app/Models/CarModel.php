<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class CarModel
 *
 * @property int $id
 * @property int $make_id
 * @property string|null $name
 * @property int $year_start
 * @property int|null $year_end
 *
 * @property CarMake $carMake
 * @property Collection|CarTrim[] $carTrims
 * @property Collection|Listing[] $listings
 *
 * @package App\Models
 */
class CarModel extends Model
{
    public const TABLE_NAME = 'car_models';
    public const ID = 'id';
    public const MAKE_ID = 'make_id';
    public const NAME = 'name';
    public const YEAR_START = 'year_start';
    public const YEAR_END = 'year_end';

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = self::TABLE_NAME;

    /**
     * Timestamp.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Casted fields.
     *
     * @var string[]
     */
    protected $casts = [
        self::ID => 'int',
        self::MAKE_ID => 'int',
        self::YEAR_START => 'int',
        self::YEAR_END => 'int',
    ];

    /**
     * Fill able fields.
     *
     * @var string[]
     */
    protected $fillable = [
        self::MAKE_ID,
        self::NAME,
        self::YEAR_START,
        self::YEAR_END,
    ];

    /**
     * Get Car make.
     *
     * @return BelongsTo
     */
    public function carMake(): BelongsTo
    {
        return $this->belongsTo(CarMake::class, self::MAKE_ID);
    }

    /**
     * Get all Car trims.
     *
     * @return HasMany
     */
    public function carTrims(): HasMany
    {
        return $this->hasMany(CarTrim::class, 'model_id');
    }

    /**
     * Get all listings.
     *
     * @return HasMany
     */
    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class, 'model_id');
    }
}
