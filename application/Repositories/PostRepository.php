<?php

namespace App\Repositories;

use App\Repositories\Contracts\PostRepositoryInterface;
use App\Eloquent\Post;
use Exception;

/**
 * Class PostRepository
 * @package App\Repositories
 */
class PostRepository implements PostRepositoryInterface
{
	/**
	 * Post Model
	 *
	 * @var \App\Eloquent\Post
	 */
	protected $post;

	/**
	 * Create a new instance of postRepo
	 */
	public function __construct()
	{
		//Inject post model in the repo
		$this->post = new Post;
	}

	/**
	 * Paginate user posts
	 *
	 * @param \App\Eloquent\User $user
	 * @param int $numberPerPage
	 * @return \Illuminate\Pagination\LengthAwarePaginator|null
	 */
	public function paginateUserPosts($user = null, $numberPerPage = 3)
	{
		try {
			//Return post pagination
			return $user->posts()->orderBy('created_at', 'desc')->paginate($numberPerPage);
		} catch (Exception $e) {
			//Unexpected error return nul
			return null;
		}
	}
}