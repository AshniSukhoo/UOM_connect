<?php

namespace App\Repositories;

use App\Repositories\Contracts\PostRepositoryInterface;
use App\Eloquent\Post;
use Carbon\Carbon;
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
	 * Get post and it
	 *
	 * @param string $postId
	 * @return \App\Eloquent\Post
	 */
	public function getPost($postId = '')
	{
		//Return post based on Id
		return $this->post->findOrFail($postId);
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
			//Get CI super object
			$ci = & get_instance();
			//Return post pagination
			return $user->posts()->orderBy('created_at', 'desc')->paginate(
				$numberPerPage,
				['*'],
				'page',
				($ci->input->get('page') != false?$ci->input->get('page'):1)
			);
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
			//Get CI super object
			$ci = & get_instance();
			//Paginate comments of post
			$comments = $post->comments()->orderBy('created_at', 'desc')->paginate(
				$numberPerPage,
				['*'],
				'commentPage',
				($ci->input->get('commentPage') != false?$ci->input->get('commentPage'):1)
			);
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

	/**
	 * Creates a new post for the user
	 *
	 * @param string $post
	 * @param \App\Eloquent\User $user
	 * @return \App\Eloquent\Post
	 */
	public function newPost($post = '', $user = null)
	{
		//Create new post
		return $user->posts()->create([
			'content' => $post,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
		]);
	}
}