<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Listing
 * 
 * @property int $id
 * @property int $carModelId
 * @property int $carTrimId
 * @property int $year
 * @property Carbon $createdAt
 * @property Carbon $updatedAt
 * @property Carbon|null $deletedAt
 * 
 * @property CarModel $car_model
 * @property CarTrim $car_trim
 * @property Collection|Document[] $documents
 *
 * @package App\Models
 */
class Listing extends Model
{
	protected $table = 'listings';
	public $timestamps = false;

	protected $casts = [
		'carModelId' => 'int',
		'carTrimId' => 'int',
		'year' => 'int'
	];

	protected $dates = [
		'createdAt',
		'updatedAt',
		'deletedAt'
	];

	protected $fillable = [
		'carModelId',
		'carTrimId',
		'year',
		'createdAt',
		'updatedAt',
		'deletedAt'
	];

	public function car_model()
	{
		return $this->belongsTo(CarModel::class, 'carModelId');
	}

	public function car_trim()
	{
		return $this->belongsTo(CarTrim::class, 'carTrimId');
	}

	public function documents()
	{
		return $this->hasMany(Document::class, 'listingId');
	}
}
