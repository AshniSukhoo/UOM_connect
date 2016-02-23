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

	/**
	 * Show add as friend button
	 *
	 * @param string $userId
	 * @param string $btnSize
	 * @return string
	 */
	public function addAsFriendButton($userId = null, $btnSize = 'md')
	{
		//Return add as friend button for a user
		return remove_carriage_return(
			'<a href="javascript:;" class="btn btn-default btn-'.$btnSize.' add-friend" data-user-id="'.(($userId != null)?$userId:':userId').'">
				<i class="fa fa-user-plus"></i> Add as Friend
			</a>'
		);
	}

	/**
	 * Show the accept friend request button
	 *
	 * @param string $userId
	 * @param string $btnSize
	 * @return string
	 */
	public function acceptFriendRequestButton($userId = null, $btnSize = 'md')
	{
		//Return button
		return remove_carriage_return(
			'<a href="javascript:;" class="btn btn-primary btn-'.$btnSize.' accept-friend-request" data-user-id="'.(($userId != null)?$userId:':userId').'">
				<i class="fa fa-check"></i> Accept Friend Request
			</a>'
		);
	}

	/**
	 * Show ignore friend request button
	 *
	 * @param string $userId
	 * @param string $btnSize
	 * @return string
	 */
	public function ignoreFriendRequestButton($userId = null, $btnSize = 'md')
	{
		//Return button
		return remove_carriage_return(
			'<a href="javascript:;" class="btn btn-default btn-'.$btnSize.' ignore-friend-request" data-user-id="'.(($userId != null)?$userId:':userId').'">
				<i class="fa fa-times"></i> Ignore request
			</a>'
		);
	}

	/**
	 * Show cancel friend request button
	 *
	 * @param string $userId
	 * @param string $btnSize
	 * @return string
	 */
	public function cancelFriendRequestButton($userId = null, $btnSize = 'md')
	{
		//Return button
		return remove_carriage_return(
			'<a href="javascript:;" class="btn btn-default btn-'.$btnSize.' cancel-friend-request" data-user-id="'.(($userId != null)?$userId:':userId').'">
				<i class="fa fa-times"></i> Cancel Friend Request
			</a>'
		);
	}

	/**
	 * Show unfriend button
	 *
	 * @param string $userId
	 * @param string $btnSize
	 * @return string
	 */
	public function unfriendButton($userId = null, $btnSize = 'md')
	{
		//Return button
		return remove_carriage_return(
			'<a href="javascript:;" class="btn btn-default btn-'.$btnSize.' unfriend" data-user-id="'.(($userId != null)?$userId:':userId').'">
				<i class="fa fa-user-times"></i> Unfriend
			</a>'
		);
	}
}