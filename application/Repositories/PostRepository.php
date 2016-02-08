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

	/**
	 * Paginate comments on post
	 *
	 * @param \App\Eloquent\Post $post
	 * @param int $numberPerPage
	 * @return \Illuminate\Pagination\LengthAwarePaginator|null
	 */
	public function paginateComments($post = null, $numberPerPage = 5)
	{
		try {
			//Paginate comments of post
			$comments = $post->comments()->orderBy('created_at', 'desc')->paginate($numberPerPage);
			//Check if we have comments
			if($comments->count() > 0) {
				//Set comments path
				return $comments->setPath(base_url().'posts/'.$post->id.'/comments');
			}
		} catch (Exception $e) {
			//Unexpected error
			return null;
		}
	}
}