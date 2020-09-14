<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Preference
 *
 * @property int $id
 * @property bool|null $notifications_push
 * @property bool|null $notifications_email
 * @property Carbon|null $updated_at
 *
 * @property User $user
 *
 * @package App\Models
 */
class Preference extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'preferences';

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
        'notifications_push' => 'bool',
        'notifications_email' => 'bool',
    ];

    /**
     * Fill able fields.
     *
     * @var string[]
     */
    protected $fillable = [
        'notifications_push',
        'notifications_email',
    ];

    /**
     * Get user.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }
}
