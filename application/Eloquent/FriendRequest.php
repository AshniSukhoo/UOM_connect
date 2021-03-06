<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FriendRequest
 * @package App\Eloquent
 */
class FriendRequest extends Model
{
	/**
	 * Model's trait
	 */
	use SoftDeletes;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'friend_requests';

	/**
	 * The primary key for the model.
	 *
	 * @var string
	 */
	protected $primaryKey = 'id';

	/**
	 * Indicates if the IDs are auto-incrementing.
	 *
	 * @var bool
	 */
	public $incrementing = true;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at'
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'sender',
		'receiver',
	];

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = true;

	/**
	 * Returns only not notified
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeNotNotified($query)
	{
		//Return not notified rows only
		return $query->where('notified', 0);
	}

	/**
	 * Return sender of this request
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function theSender()
	{
		//Return sender
		return $this->belongsTo('App\Eloquent\User', 'sender', 'id');
	}

	/**
	 * Return receiver of this request
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function theReceiver()
	{
		//Return receiver
		return $this->belongsTo('App\Eloquent\User', 'receiver', 'id');
	}
}