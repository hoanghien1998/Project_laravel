<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Listing
 *
 * @property int $id
 * @property int $car_model_id
 * @property int $car_trim_id
 * @property int $year
 * @property int $created_by
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 *
 * @property CarModel $carModel
 * @property CarTrim $carTrim
 * @property Collection|Document[] $documents
 *
 * @package App\Models
 */
class Listing extends Model
{
    use SoftDeletes;

    public const TABLE_NAME = 'listings';
    public const ID = 'id';
    public const CAR_MODEL_ID = 'car_model_id';
    public const CAR_TRIM_ID = 'car_trim_id';
    public const YEAR = 'year';
    public const PRICE = 'price';
    public const DESCRIPTION = 'description';
    public const CREATED_AT = 'created_at';
    public const CREATED_BY = 'created_by';
    public const UPDATED_AT = 'updated_at';
    public const DELETED_AT = 'deleted_at';

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = self::TABLE_NAME;

    /**
     * Casted fields.
     *
     * @var string[]
     */
    protected $casts = [
        self::CAR_MODEL_ID => 'int',
        self::CAR_TRIM_ID => 'int',
        self::YEAR => 'int',
        self::PRICE => 'int',
        self::DESCRIPTION => 'string',
        self::CREATED_BY => 'int',
    ];

    /**
     * Fill able fields.
     *
     * @var string[]
     */
    protected $fillable = [
        self::CAR_MODEL_ID,
        self::CAR_TRIM_ID,
        self::YEAR,
        self::PRICE,
        self::DESCRIPTION,
        self::CREATED_BY,
    ];

    /**
     * Get created by user.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, self::CREATED_BY);
    }

    /**
     * Get car model.
     *
     * @return BelongsTo
     */
    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class, self::CAR_MODEL_ID);
    }

    /**
     * Get Car trim.
     *
     * @return BelongsTo
     */
    public function carTrim(): BelongsTo
    {
        return $this->belongsTo(CarTrim::class, self::CAR_TRIM_ID);
    }

    /**
     * Get documents.
     *
     * @return HasMany
     */
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, Document::LISTING_ID);
    }
}
