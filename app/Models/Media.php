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
	protected $table = 'medias';
	public $timestamps = false;

	protected $casts = [
		'sequence' => 'int',
		'mediable_id' => 'int'
	];

	protected $fillable = [
		'thumbnail',
		'full',
		'sequence',
		'mediable_id',
		'mediable_type'
	];
}
