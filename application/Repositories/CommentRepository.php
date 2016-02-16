<?php

namespace App\Repositories;

use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Eloquent\Comment;
use Carbon\Carbon;

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

	/**
	 * Create a new Comment on a resource
	 *
	 * @param mixed $resource
	 * @param string $comment
	 * @param \App\Eloquent\User $user
	 * @return \App\Eloquent\Comment
	 */
	public function createComment($resource = null, $comment = '', $user = null)
	{
		//Create new comment
		return $resource->comments()->create([
			'user_id' => $user->id,
			'content' => $comment,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
		]);
	}
}