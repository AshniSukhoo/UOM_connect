<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Eloquent\Observers\LikeObserver;

/**
 * Class Like
 * @package App\Eloquent
 */
class Like extends Model
{
	/**
	 * The model's trait
	 */
	use SoftDeletes, LikeObserver;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'likes';

	/**
	 * The primary key for the model.
	 *
	 * @var string
	 */
	protected $primaryKey = 'id';

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = true;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at',
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'user_id',
		'resourceable_type',
		'resourceable_id',
		'created_at',
		'updated_at',
		'deleted_at',
	];

	/**
	 * A like belongs to one user
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		//Return the user making the post
		return $this->belongsTo('App\Eloquent\User', 'user_id', 'id');
	}

	/**
	 * The resource on which the like is
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphTo
	 */
	public function resourceable()
	{
		//Return morph
		return $this->morphTo();
	}
}
