<?php

namespace App\Repositories;

use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Eloquent\Comment;

/**
 * Class CommentRepository
 * @package App\Repositories
 */
class CommentRepository implements CommentRepositoryInterface
{
	/**
	 * The comment model
	 *
	 * @var \App\Eloquent\Comment
	 */
	protected $comment;

	/**
	 * Create a new instance of the comment repo
	 */
	public function __construct()
	{
		//Inject comment model in the repo
		$this->comment = new Comment;
	}

	/**
	 * Get a single comment and return it
	 *
	 * @param string $commentId
	 * @return \App\Eloquent\Comment
	 */
	public function getComment($commentId = '')
	{
		//Return comment
		return $this->comment->findOrFail($commentId);
	}

}