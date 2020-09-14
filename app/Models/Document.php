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
 * @property int|null $listing_id
 * @property string $group
 * @property int|null $sequence
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Listing $listing
 *
 * @package App\Models
 */
class Document extends Model
{
	protected $table = 'documents';

	protected $casts = [
		'listing_id' => 'int',
		'sequence' => 'int'
	];

	protected $fillable = [
		'listing_id',
		'group',
		'sequence'
	];

	public function listing()
	{
		return $this->belongsTo(Listing::class);
	}
}
