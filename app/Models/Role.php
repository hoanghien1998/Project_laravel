<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use Saritasa\Roles\Models\Role as BaseRoleModel;

/**
 * Class Role
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 *
 * @property Collection|User[] $users
 *
 * @method static Builder|Role whereId($value)
 * @method static Builder whereSlug($value)
 *
 * @package App\Models
 */

class Role extends BaseRoleModel
{
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
