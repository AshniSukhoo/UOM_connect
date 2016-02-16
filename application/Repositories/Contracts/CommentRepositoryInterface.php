<?php

namespace App\Repositories\Contracts;

/**
 * Interface CommentRepositoryInterface
 * @package App\Repositories\Contracts
 */
interface CommentRepositoryInterface
{
	/**
	 * Get a single comment and return it
	 *
	 * @param string $commentId
	 * @return \App\Eloquent\Comment
	 */
	public function getComment($commentId = '');

	/**
	 * Create a new Comment on a resource
	 *
	 * @param mixed $resource
	 * @param string $comment
	 * @param \App\Eloquent\User $user
	 * @return \App\Eloquent\Comment
	 */
	public function createComment($resource = null, $comment = '', $user = null);
}