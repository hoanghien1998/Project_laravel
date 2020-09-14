<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PasswordReset
 *
 * @property string $email
 * @property string $token
 * @property Carbon|null $created_at
 *
 * @package App\Models
 */
class PasswordReset extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'password_resets';

    /**
     * Incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Timestamp.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Hidden fields.
     *
     * @var string[]
     */
    protected $hidden = [
        'token',
    ];

    /**
     * Fill able fields.
     *
     * @var string[]
     */
    protected $fillable = [
        'email',
        'token',
    ];
}
