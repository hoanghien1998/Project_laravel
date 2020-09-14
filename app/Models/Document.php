<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Document
 *
 * @property int $id
 * @property int|null $listing_id
 * @property string $group
 * @property int|null $sequence
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Listing $listing
 *
 * @package App\Models
 */
class Document extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'documents';

    /**
     * Casted fields.
     *
     * @var string[]
     */
    protected $casts = [
        'listing_id' => 'int',
        'sequence' => 'int',
    ];

    /**
     * Fill able fields.
     *
     * @var string[]
     */
    protected $fillable = [
        'listing_id',
        'group',
        'sequence',
    ];

    /**
     * Get Listing.
     *
     * @return BelongsTo
     */
    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }
}
