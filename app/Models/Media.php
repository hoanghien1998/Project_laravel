<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Media
 *
 * @property int $id
 * @property string|null $thumbnail
 * @property string $full
 * @property int|null $sequence
 * @property int $mediable_id
 * @property string $mediable_type
 *
 * @package App\Models
 */
class Media extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'medias';

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
        'sequence' => 'int',
        'mediable_id' => 'int',
    ];

    /**
     * Fill able fields.
     *
     * @var string[]
     */
    protected $fillable = [
        'thumbnail',
        'full',
        'sequence',
        'mediable_id',
        'mediable_type',
    ];
}
