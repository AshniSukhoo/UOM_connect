<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Presenters\PostPresenter;
use App\ModelFunctions\PostFunctions;
use App\Eloquent\Observers\PostObserver;

/**
 * Class Post
 * @package App\Eloquent
 */
class Post extends Model
{
	/**
	 * The model's trait
	 */
	use SoftDeletes, PostPresenter, PostFunctions;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'posts';

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
		'content',
		'created_at',
		'updated_at',
		'deleted_at',
	];

	/**
	 * A post belongs to one user
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		//Return the user making the post
		return $this->belongsTo('App\Eloquent\User', 'user_id', 'id');
	}

	/**
	 * All comments of a post
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function comments()
	{
		//Return comments
		return $this->hasMany('App\Eloquent\Comment', 'post_id', 'id');
	}

	/**
	 * A post has many likes
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
	 */
	public function likes()
	{
		//Return morph many
		return $this->morphMany('App\Eloquent\Like', 'resourceable');
	}
}
