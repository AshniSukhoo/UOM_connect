<?php

namespace App\Repositories\Contracts;

/**
 * Interface LikeRepositoryInterface
 * @package App\Repositories\Contracts
 */
interface LikeRepositoryInterface
{
	/**
	 * Like a resource
	 *
	 * @param mixed $resource
	 * @param \App\Eloquent\User $user
	 * @return bool
	 */
	public function likeResource($resource = null, $user = null);

	/**
	 * Unlike a resource
	 *
	 * @param mixed $resource
	 * @param \App\Eloquent\User $user
	 * @return bool
	 */
	public function unlikeResource($resource = null, $user = null);
}