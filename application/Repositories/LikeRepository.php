<?php

namespace App\Repositories;

use App\Repositories\Contracts\LikeRepositoryInterface;
use App\Eloquent\Like;
use Carbon\Carbon;

/**
 * Class LikeRepository
 * @package App\Repositories
 */
class LikeRepository implements LikeRepositoryInterface
{
	/**
	 * The Like Model
	 *
	 * @var \App\Eloquent\Like
	 */
	protected $like;

	/**
	 * Create a new instance of the LikeRepository
	 */
	public function __construct()
	{
		//Inject like in the repo
		$this->like = new Like;
	}

	/**
	 * Like a resource
	 *
	 * @param mixed $resource
	 * @param \App\Eloquent\User $user
	 * @return bool
	 */
	public function likeResource($resource = null, $user = null)
	{
		//Check if user has previously liked this resource
		if($resource->likes()->onlyTrashed()->where('likes.user_id', $user->id)->count() == 1) {
			//Yes so restore the trashed liked and return true
			$resource->likes()->onlyTrashed()->where('likes.user_id', $user->id)->restore();
			//Return completion
			return true;
		}
		//This is a new like so create it
		$resource->likes()->create([
			'user_id' => $user->id,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
		]);
		//Return completion
		return true;
	}

	/**
	 * Unlike a resource
	 *
	 * @param mixed $resource
	 * @param \App\Eloquent\User $user
	 * @return bool
	 */
	public function unlikeResource($resource = null, $user = null)
	{
		//Unlike the resources
		$resource->likes()->where('likes.user_id', $user->id)->delete();
		//Return completion
		return true;
	}
}