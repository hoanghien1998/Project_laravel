<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Role
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 *
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Role extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * Timestamp.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Fill able fields.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Get all users.
     *
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
