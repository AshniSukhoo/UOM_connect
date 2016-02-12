<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Presenters\CommentPresenter;
use App\ModelFunctions\CommentFunctions;

/**
 * Class Comment
 * @package App\Eloquent
 */
class Comment extends Model
{
	/**
	 * The model's trait
	 */
	use SoftDeletes, CommentPresenter, CommentFunctions;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'comments';

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
		'post_id',
		'user_id',
		'content',
		'created_at',
		'updated_at',
		'deleted_at',
	];

	/**
	 * Return user commenter
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		//To one user only
		return $this->belongsTo('App\Eloquent\User', 'user_id', 'id');
	}

	/**
	 * Returns post on which comment is
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function post()
	{
		//On one post only
		return $this->belongsTo('App\Eloquent\Post', 'post_id', 'id');
	}

	/**
	 * A comment has many likes
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
	 */
	public function likes()
	{
		//Return morph many
		return $this->morphMany('App\Eloquent\Like', 'resourceable');
	}
}