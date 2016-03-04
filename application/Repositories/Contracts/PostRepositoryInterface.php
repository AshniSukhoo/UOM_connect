<?php

namespace App\Repositories\Contracts;

/**
 * Interface PostRepositoryInterface
 * @package App\Repositories\Contracts
 */
interface PostRepositoryInterface
{
	/**
	 * Get post and it
	 *
	 * @param string $postId
	 * @return \App\Eloquent\Post
	 */
	public function getPost($postId = '');

	/**
	 * Paginate user posts
	 *
	 * @param \App\Eloquent\User $user
	 * @param int $numberPerPage
	 * @return \Illuminate\Pagination\LengthAwarePaginator|null
	 */
	public function paginateUserPosts($user = null, $numberPerPage = 3);

	/**
	 * Paginate comments on post
	 *
	 * @param \App\Eloquent\Post $post
	 * @param int $numberPerPage
	 * @return \Illuminate\Pagination\LengthAwarePaginator|null
	 */
	public function paginateComments($post = null, $numberPerPage = 5);

	/**
	 * Creates a new post for the user
	 *
	 * @param string $post
	 * @param \App\Eloquent\User $user
	 * @return \App\Eloquent\Post
	 */
	public function newPost($post = '', $user = null);

    /**
     * Returns the feeds for a user
     *
     * @param \App\Eloquent\User $user
     * @param int $numberPerPage
     * @return \Illuminate\Pagination\LengthAwarePaginator|null
     */
    public function feeds($user = null, $numberPerPage = 3);
}
