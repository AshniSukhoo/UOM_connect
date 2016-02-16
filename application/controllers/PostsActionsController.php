<?php

use App\Repositories\PostRepository;
use App\Repositories\LikeRepository;
use App\Repositories\CommentRepository;

/**
 * Class PostsActionsController
 */
class PostsActionsController extends CI_Controller
{
	/**
	 * The Post repository service
	 *
	 * @var \App\Repositories\PostRepository
	 */
	protected $postRepo;

	/**
	 * The Comment repository service
	 *
	 * @var \App\Repositories\CommentRepository
	 */
	protected $commentRepo;

	/**
	 * The Like repository service
	 *
	 * @var \App\Repositories\LikeRepository
	 */
	protected $likeRepo;

	/**
	 * Create new instance of PostsActionsController
	 *
	 * @return void
	 */
	public function __construct()
	{
		//Execute parent constructor
		parent::__construct();
		//Inject post repo in the controller
		$this->postRepo = new PostRepository;
		//Inject comment repo in controller
		$this->commentRepo = new CommentRepository;
		//Inject like repo in controller
		$this->likeRepo = new LikeRepository;
	}

	/**
	 * Creates a new post
	 *
	 * @return string
	 */
	public function postCreateNewPost()
	{
		try {
			//Must be an ajax request
			if(!$this->input->is_ajax_request()) {
				//Raise error
				throw new Exception('The request is not allowed', 422);
			}
			//User must be logged in
			if(!$this->auth->check()) {
				//Raise error
				throw new Exception('You must be logged in to proceed', 422);
			}
			//Set validation
			$this->form_validation->set_rules('post', 'Post', 'required|xss_clean');
			//Apply validation
			if($this->form_validation->run() == false) {
				//Raise error
				throw new Exception('Missing post', '422');
			}
			//Create post and return
			echo json_encode([
				'error' => false,
				'post' => $this->load->view('partials/_single-post', [
					'post' => $this->postRepo->newPost(
						$this->input->post('post'),
						$this->auth->user()
					)
				], true),
			]);
		} catch (Exception $e) {
			//Unexpected error
			echo json_encode([
				'error' => true,
				'message' => $e->getMessage()
			]);
		}
	}

	/**
	 * Get and return next comments bach
	 *
	 * @param string $postId
	 * @return string
	 */
	public function getComments($postId = '')
	{
		try {
			//Return Json Data
			echo json_encode([
				'error' => false,
				'comments' => $this->load->view(
					'partials/_comments-grid',
					[
						'comments' => $this->postRepo->paginateComments($this->postRepo->getPost($postId))
					],
					true
				),
			]);
		} catch (Exception $e) {
			//Unexpected error
			echo json_encode([
				'error' => true,
				'message' => $e->getMessage()
			]);
		}
	}

	/**
	 * Create a new like on a post
	 *
	 * @return string
	 */
	public function postLike()
	{
		try {
			//Must be an ajax request
			if(!$this->input->is_ajax_request()) {
				//Raise error
				throw new Exception('The request is not allowed', 422);
			}
			//User must be logged in
			if(!$this->auth->check()) {
				//Raise error
				throw new Exception('You must be logged in to proceed', 422);
			}
			//Set validation for getting the post ID
			$this->form_validation->set_rules('post_id', 'Post Identifier', 'required|xss_clean');
			//Apply validation
			if($this->form_validation->run() == false) {
				//Raise error
				throw new Exception('Missing post identification', '422');
			}
			//Get the post to like
			$post = $this->postRepo->getPost($this->input->post('post_id'));
			//Like the post
			$this->likeRepo->likeResource($post, $this->auth->user());
			//Echo like grid back
			echo json_encode([
				'error' => false,
				'postLikes' => Html::showPostLikes($post, $this->auth->user())
			]);
		} catch (Exception $e) {
			//Unexpected error
			echo json_encode([
				'error' => true,
				'message' => $e->getMessage()
			]);
		}
	}

	/**
	 * Unlike a post
	 *
	 * @return string
	 */
	public function deleteUnlike()
	{
		try {
			//Must be an ajax request
			if(!$this->input->is_ajax_request()) {
				//Raise error
				throw new Exception('The request is not allowed', 422);
			}
			//User must be logged in
			if(!$this->auth->check()) {
				//Raise error
				throw new Exception('You must be logged in to proceed', 422);
			}
			//Set validation for getting the post ID
			$this->form_validation->set_rules('post_id', 'Post Identifier', 'required|xss_clean');
			//Apply validation
			if($this->form_validation->run() == false) {
				//Raise error
				throw new Exception('Missing post identification', '422');
			}
			//Get the post to unlike
			$post = $this->postRepo->getPost($this->input->post('post_id'));
			//Unlike the post
			$this->likeRepo->unlikeResource($post, $this->auth->user());
			//Echo like grid back
			echo json_encode([
				'error' => false,
				'postLikes' => Html::showPostLikes($post, $this->auth->user())
			]);
		} catch (Exception $e) {
			//Unexpected error
			echo json_encode([
				'error' => true,
				'message' => $e->getMessage()
			]);
		}
	}

	/**
	 * Like a comment
	 *
	 * @return string
	 */
	public function postLikeComment()
	{
		try {
			//Must be an ajax request
			if(!$this->input->is_ajax_request()) {
				//Raise error
				throw new Exception('The request is not allowed', 422);
			}
			//User must be logged in
			if(!$this->auth->check()) {
				//Raise error
				throw new Exception('You must be logged in to proceed', 422);
			}
			//Set validation
			$this->form_validation->set_rules('comment_id', 'Comment Identifier', 'required|xss_clean');
			//Apply validation
			if($this->form_validation->run() == false) {
				//Raise error
				throw new Exception('Missing comment identification', '422');
			}
			//Get the comment to like
			$comment = $this->commentRepo->getComment($this->input->post('comment_id'));
			//Like the post
			$this->likeRepo->likeResource($comment, $this->auth->user());
			//Echo like grid back
			echo json_encode([
				'error' => false,
				'commentLikes' => Html::showCommentLikes($comment)
			]);
		} catch (Exception $e) {
			//Unexpected error
			echo json_encode([
				'error' => true,
				'message' => $e->getMessage()
			]);
		}
	}

	/**
	 * Unlike a comment
	 *
	 * @return string
	 */
	public function deleteUnlikeComment()
	{
		try {
			//Must be an ajax request
			if(!$this->input->is_ajax_request()) {
				//Raise error
				throw new Exception('The request is not allowed', 422);
			}
			//User must be logged in
			if(!$this->auth->check()) {
				//Raise error
				throw new Exception('You must be logged in to proceed', 422);
			}
			//Set validation
			$this->form_validation->set_rules('comment_id', 'Comment Identifier', 'required|xss_clean');
			//Apply validation
			if($this->form_validation->run() == false) {
				//Raise error
				throw new Exception('Missing comment identification', '422');
			}
			//Get the comment to unlike
			$comment = $this->commentRepo->getComment($this->input->post('comment_id'));
			//Like the post
			$this->likeRepo->unlikeResource($comment, $this->auth->user());
			//Echo like grid back
			echo json_encode([
				'error' => false,
				'commentLikes' => Html::showCommentLikes($comment)
			]);
		} catch (Exception $e) {
			//Unexpected error
			echo json_encode([
				'error' => true,
				'message' => $e->getMessage()
			]);
		}
	}

	/**
	 * Create a new comment on a post
	 *
	 * @return string
	 */
	public function postComment()
	{
		try {
			//Must be an ajax request
			if(!$this->input->is_ajax_request()) {
				//Raise error
				throw new Exception('The request is not allowed', 422);
			}
			//User must be logged in
			if(!$this->auth->check()) {
				//Raise error
				throw new Exception('You must be logged in to proceed', 422);
			}
			//Set validation
			$this->form_validation->set_rules('post_id', 'Post Identifier', 'required|xss_clean');
			$this->form_validation->set_rules('comment', 'Comment', 'required|xss_clean');
			//Apply validation
			if($this->form_validation->run() == false) {
				//Raise error
				throw new Exception('Missing parameters', '422');
			}
			//Create comment and return
			echo json_encode([
				'error' => false,
				'commentRow' => $this->load->view('partials/_single-comment-row', [
					'comment' => $this->commentRepo->createComment(
						$this->postRepo->getPost($this->input->post('post_id')),
						$this->input->post('comment'),
						$this->auth->user()
					)
				], true),
			]);
		} catch (Exception $e) {
			//Unexpected error
			echo json_encode([
				'error' => true,
				'message' => $e->getMessage()
			]);
		}
	}
}