<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Listing
 *
 * @property int $id
 * @property int $car_model_id
 * @property int $car_trim_id
 * @property int $year
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 *
 * @property CarModel $car_model
 * @property CarTrim $car_trim
 * @property Collection|Document[] $documents
 *
 * @package App\Models
 */
class Listing extends Model
{
	use SoftDeletes;
	protected $table = 'listings';

	protected $casts = [
		'car_model_id' => 'int',
		'car_trim_id' => 'int',
		'year' => 'int'
	];

	protected $fillable = [
		'car_model_id',
		'car_trim_id',
		'year'
	];

	public function car_model()
	{
		return $this->belongsTo(CarModel::class);
	}

	public function car_trim()
	{
		return $this->belongsTo(CarTrim::class);
	}

	public function documents()
	{
		return $this->hasMany(Document::class);
	}
}
