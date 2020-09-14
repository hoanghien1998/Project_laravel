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
 * Class CarTrim
 *
 * @property int $id
 * @property int $model_id
 * @property string $name
 *
 * @property CarModel $carModel
 * @property Collection|Listing[] $listings
 *
 * @package App\Models
 */
class CarTrim extends Model
{
    public const TABLE_NAME = 'car_trims';
    public const ID = 'id';
    public const MODEL_ID = 'model_id';
    public const NAME = 'name';

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
        self::MODEL_ID => 'int',
    ];

    /**
     * Fill able fields.
     *
     * @var string[]
     */
    protected $fillable = [
        self::MODEL_ID,
        self::NAME,
    ];

    /**
     * Get car model.
     *
     * @return BelongsTo
     */
    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class, self::MODEL_ID);
    }

    /**
     * Get listings.
     *
     * @return HasMany
     */
    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class, 'car_trim_id');
    }
}
