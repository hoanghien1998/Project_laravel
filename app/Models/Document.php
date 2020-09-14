<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Document
 * 
 * @property int $id
 * @property int|null $listingId
 * @property string $group
 * @property int|null $sequence
 * @property Carbon $createdAt
 * @property Carbon $updatedAt
 * 
 * @property Listing $listing
 *
 * @package App\Models
 */
class Document extends Model
{
	protected $table = 'documents';
	public $timestamps = false;

	protected $casts = [
		'listingId' => 'int',
		'sequence' => 'int'
	];

	protected $dates = [
		'createdAt',
		'updatedAt'
	];

	protected $fillable = [
		'listingId',
		'group',
		'sequence',
		'createdAt',
		'updatedAt'
	];

	public function listing()
	{
		return $this->belongsTo(Listing::class, 'listingId');
	}
}
