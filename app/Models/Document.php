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
    public const TABLE_NAME = 'documents';
    public const ID = 'id';
    public const LISTING_ID = 'listing_id';
    public const GROUP = 'group';
    public const SEQUENCE = 'sequence';
    public const THUMBNAIL = 'thumbnail';
    public const FULL = 'full';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

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
        self::LISTING_ID => 'int',
        self::SEQUENCE => 'int',
    ];

    /**
     * Fill able fields.
     *
     * @var string[]
     */
    protected $fillable = [
        self::LISTING_ID ,
        self::GROUP,
        self::SEQUENCE,
        self::FULL,
        self::THUMBNAIL,
    ];

    /**
     * Get Listing.
     *
     * @return BelongsTo
     */
    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class, self::LISTING_ID);
    }
}
