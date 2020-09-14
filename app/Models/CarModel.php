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
 * @property int $make_id
 * @property string|null $name
 * @property int $year_start
 * @property int|null $year_end
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
		'make_id' => 'int',
		'year_start' => 'int',
		'year_end' => 'int'
	];

	protected $fillable = [
		'make_id',
		'name',
		'year_start',
		'year_end'
	];

	public function car_make()
	{
		return $this->belongsTo(CarMake::class, 'make_id');
	}

	public function car_trims()
	{
		return $this->hasMany(CarTrim::class, 'model_id');
	}

	public function listings()
	{
		return $this->hasMany(Listing::class);
	}
}
