<?php

namespace App\Services;

/**
 * Class HtmlBuilder
 * @package App\Services
 */
class HtmlBuilder
{
	/**
	 * Get a loader string when more comments loading
	 *
	 * @return string
	 */
	public function moreCommentsLoader()
	{
		//Get CI super object
		$ci = & get_instance();
		//Return loader
		return remove_carriage_return($ci->load->view('partials/_more-comments-loader', [], true));
	}

	/**
	 * Get a loader string
	 *
	 * @return string
	 */
	public function morePostsLoader()
	{
		//Get CI super object
		$ci = & get_instance();
		//Return loader
		return remove_carriage_return($ci->load->view('partials/_more-posts-loader', [], true));
	}

	/**
	 * Show people who has liked a post
	 *
	 * @param \App\Eloquent\Post $post
	 * @param \App\Eloquent\User $viewer
	 * @return string
	 */
	public function showPostLikes($post = null, $viewer = null)
	{
		//No likes
		if($post->likes()->count() == 0) {
			//We return blank
			return '';
		}
		//return the string of like presentation
		return '<span>'.$post->getLikesAsHumanReadable($viewer).'</span>';
	}

	/**
	 * Show likes on a comment
	 *
	 * @param \App\Eloquent\Comment $comment
	 * @return string
	 */
	public function showCommentLikes($comment = null)
	{
		//No likes
		if($comment->likes()->count() == 0) {
			//We return blank
			return '';
		}
		//Return comment likes
		return ' - <i class="fa fa-thumbs-up"></i> '.$comment->likes()->count();
	}
}