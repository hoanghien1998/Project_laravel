<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CarTrim
 * 
 * @property int $id
 * @property int $modelId
 * @property string $name
 * 
 * @property CarModel $car_model
 * @property Collection|Listing[] $listings
 *
 * @package App\Models
 */
class CarTrim extends Model
{
	protected $table = 'car_trims';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'modelId' => 'int'
	];

	protected $fillable = [
		'modelId',
		'name'
	];

	public function car_model()
	{
		return $this->belongsTo(CarModel::class, 'modelId');
	}

	public function listings()
	{
		return $this->hasMany(Listing::class, 'carTrimId');
	}
}
