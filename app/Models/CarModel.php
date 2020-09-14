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
 * @property CarMake $car_make
 * @property Collection|CarTrim[] $car_trims
 * @property Collection|Listing[] $listings
 *
 * @package App\Models
 */
class CarModel extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'car_models';

    /**
     * Incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

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
        'id' => 'int',
        'make_id' => 'int',
        'year_start' => 'int',
        'year_end' => 'int',
    ];

    /**
     * Fill able fields.
     *
     * @var string[]
     */
    protected $fillable = [
        'make_id',
        'name',
        'year_start',
        'year_end',
    ];

    /**
     * Get Car make.
     *
     * @return BelongsTo
     */
    public function carMake(): BelongsTo
    {
        return $this->belongsTo(CarMake::class, 'make_id');
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
