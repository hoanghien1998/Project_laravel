<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 *
 * @property int $id
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
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * Casted fields.
     *
     * @var string[]
     */
    protected $casts = [
        'object_id' => 'int',
    ];

    /**
     * Fill able fields.
     *
     * @var string[]
     */
    protected $fillable = [
        'object_name',
        'object_id',
        'message',
    ];
}
