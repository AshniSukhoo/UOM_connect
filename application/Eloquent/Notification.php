<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Notification
 * @package App\Eloquent
 */
class Notification extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'notifications';

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
		'receiver',
		'notifier',
		'content',
		'notified',
		'type'
	];

	/**
	 * Get only not notified notifications
	 *
	 * @param $query
	 */
	public function scopeNotNotified($query)
	{
		//Only not notified
		return $query->where('notified', 0);
	}

	/**
	 * Returns the user receiver of this notification
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function theReceiver()
	{
		//Return the user model
		return $this->belongsTo('App\Eloquent\User', 'receiver', 'id');
	}

	/**
	 * Returns the user notifier of this notification
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function theNotifier()
	{
		//Return user model
		return $this->belongsTo('App\Eloquent\User', 'notifier', 'id');
	}

}