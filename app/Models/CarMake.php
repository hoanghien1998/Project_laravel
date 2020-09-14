<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class CarMake
 *
 * @property int $id
 * @property string|null $name
 *
 * @property Collection|CarModel[] $car_models
 *
 * @package App\Models
 */
class CarMake extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'car_makes';

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
    ];

    /**
     * Fill able fields.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get Car models.
     *
     * @return HasMany
     */
    public function carModels(): HasMany
    {
        return $this->hasMany(CarModel::class, 'make_id');
    }
}
