<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

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
	protected $table = 'preferences';
	public $timestamps = false;

	protected $casts = [
		'notifications_push' => 'bool',
		'notifications_email' => 'bool'
	];

	protected $fillable = [
		'notifications_push',
		'notifications_email'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'id');
	}
}
