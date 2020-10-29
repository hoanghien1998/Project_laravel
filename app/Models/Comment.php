<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Comment
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $object_name
 * @property int|null $object_id
 * @property string $message
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class Comment extends Model
{
    public const TABLE_NAME = 'comments';
    public const ID = 'id';
    public const USER_ID = 'user_id';
    public const OBJECT_NAME = 'object_name';
    public const OBJECT_ID = 'object_id';
    public const MESSAGE = 'message';
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
        self::OBJECT_ID => 'int',
    ];

    /**
     * Fill able fields.
     *
     * @var string[]
     */
    protected $fillable = [
        self::OBJECT_NAME,
        self::OBJECT_ID,
        self::MESSAGE,
        self::USER_ID,
    ];

    /**
     * Get Car trim.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, self::USER_ID);
    }
}
