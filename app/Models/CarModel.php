<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CarModel
 * 
 * @property int $id
 * @property int $makeId
 * @property string|null $name
 * @property int $yearStart
 * @property int|null $yearEnd
 * 
 * @property CarMake $car_make
 * @property Collection|CarTrim[] $car_trims
 * @property Collection|Listing[] $listings
 *
 * @package App\Models
 */
class CarModel extends Model
{
	protected $table = 'car_models';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'makeId' => 'int',
		'yearStart' => 'int',
		'yearEnd' => 'int'
	];

	protected $fillable = [
		'makeId',
		'name',
		'yearStart',
		'yearEnd'
	];

	public function car_make()
	{
		return $this->belongsTo(CarMake::class, 'makeId');
	}

	public function car_trims()
	{
		return $this->hasMany(CarTrim::class, 'modelId');
	}

	public function listings()
	{
		return $this->hasMany(Listing::class, 'carModelId');
	}
}
