<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CarMake
 * 
 * @property int $id
 * @property string|null $name
 * 
 * @property Collection|CarModel[] $car_models
 *
 * @package App\Models
 */
class CarMake extends Model
{
	protected $table = 'car_makes';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'name'
	];

	public function car_models()
	{
		return $this->hasMany(CarModel::class, 'make_id');
	}
}
