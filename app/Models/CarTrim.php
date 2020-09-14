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
 * @property int $model_id
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
		'model_id' => 'int'
	];

	protected $fillable = [
		'model_id',
		'name'
	];

	public function car_model()
	{
		return $this->belongsTo(CarModel::class, 'model_id');
	}

	public function listings()
	{
		return $this->hasMany(Listing::class);
	}
}
