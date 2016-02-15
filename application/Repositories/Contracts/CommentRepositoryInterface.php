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

}