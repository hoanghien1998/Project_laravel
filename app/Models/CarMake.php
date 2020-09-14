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
 * @property Collection|CarModel[] $carModels
 *
 * @package App\Models
 */
class CarMake extends Model
{
    public const TABLE_NAME = 'car_makes';
    public const ID = 'id';
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
    ];

    /**
     * Fill able fields.
     *
     * @var string[]
     */
    protected $fillable = [
        self::NAME,
    ];

    /**
     * Get Car models.
     *
     * @return HasMany
     */
    public function carModels(): HasMany
    {
        return $this->hasMany(CarModel::class, CarModel::MAKE_ID);
    }
}
