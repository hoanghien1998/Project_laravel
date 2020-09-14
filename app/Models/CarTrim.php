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
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'car_trims';

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
        'model_id' => 'int',
    ];

    /**
     * Fill able fields.
     *
     * @var string[]
     */
    protected $fillable = [
        'model_id',
        'name',
    ];

    /**
     * Get car model.
     *
     * @return BelongsTo
     */
    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class, 'model_id');
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
