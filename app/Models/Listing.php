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

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'listings';

    /**
     * Casted fields.
     *
     * @var string[]
     */
    protected $casts = [
        'car_model_id' => 'int',
        'car_trim_id' => 'int',
        'year' => 'int',
    ];

    /**
     * Fill able fields.
     *
     * @var string[]
     */
    protected $fillable = [
        'car_model_id',
        'car_trim_id',
        'year',
    ];

    /**
     * Get car model.
     *
     * @return BelongsTo
     */
    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class, 'car_model_id');
    }

    /**
     * Get Car trim.
     *
     * @return BelongsTo
     */
    public function carTrim(): BelongsTo
    {
        return $this->belongsTo(CarTrim::class, 'car_trim_id');
    }

    /**
     * Get documents.
     *
     * @return HasMany
     */
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'listing_id');
    }
}
