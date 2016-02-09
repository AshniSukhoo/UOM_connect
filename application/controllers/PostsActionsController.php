<?php

use App\Repositories\PostRepository;

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

}