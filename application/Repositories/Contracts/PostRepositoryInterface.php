<?php

namespace App\Repositories\Contracts;

/**
 * Interface PostRepositoryInterface
 * @package App\Repositories\Contracts
 */
interface PostRepositoryInterface
{
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
}