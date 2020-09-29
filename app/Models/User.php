<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Saritasa\Database\Eloquent\Models\User as BaseUserModel;
use Saritasa\Enums\Gender;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Application User.
 *
 * @property int $id User identifier
 * @property string $first_name User first name
 * @property string $last_name User last name
 * @property string $email User email address
 * @property string $password User encoded password
 * @property string|null $facebook_id User facebook identifier
 * @property string|null $instagram_id|null User instagram identifier
 * @property Gender $gender User gender
 * @property string|null $avatar_url User avatar url
 * @property string|null $remember_token Remember token
 * @property Carbon $created_at Date when user was created
 * @property Carbon $updated_at Date when user was last time updated
 * @property Carbon|null $deleted_at Date when user was deleted
 *
 * @property-read Collection|Listing[] $listings Listing
 * @property-read Role $role Role
 */
class User extends BaseUserModel implements JWTSubject
{
    use Notifiable;

    public const DEFAULT_AVATAR = 'images/avatar/default.png';

    public const GENDER = 'gender';
    public const AVATAR_URL = 'avatar_url';

    /**
     * The attributes that should be visible in arrays.
     *
     * @inheritdoc
     */
    protected $visible = [
        self::ID,
        self::EMAIL,
        self::FIRST_NAME,
        self::LAST_NAME,
        self::CREATED_AT,
        self::AVATAR_URL,
        self::GENDER,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @inheritdoc
     */
    protected $fillable = [
        self::ID,
        self::EMAIL,
        self::PWD_FIELD,
        self::FIRST_NAME,
        self::LAST_NAME,
        self::CREATED_AT,
        self::ROLE_ID,
        self::AVATAR_URL,
        self::GENDER,
    ];

    /**
     * Mapping of enum fields.
     *
     * @var mixed[]
     */
    protected $enums = [
        self::GENDER => Gender::class,
    ];

    /**
     * Mapping of defaults fields.
     *
     * @var mixed[]
     */
    protected $defaults = [
        self::AVATAR_URL => self::DEFAULT_AVATAR,
    ];

    /**
     * {@inheritdoc}
     */
    public function getJWTIdentifier(): string
    {
        return $this->getKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    /**
     * Get listings.
     *
     * @return HasMany
     */
    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class, Listing::CREATED_BY);
    }

    /**
     * Relation with the model Role.
     *
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, User::ROLE_ID);
    }
}
