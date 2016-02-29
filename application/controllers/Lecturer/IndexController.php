<?php
use App\Repositories\PostRepository;
/**
 * Class IndexController
 */
class IndexController extends MY_Controller
{
	/**
	 * The post repository service
	 *
	 * @var \App\Repositories\PostRepository
	 */
	protected $postsRepo;

	/**
	 * Create a new instance of
	 * IndexController
	 */
	public function __construct()
	{
		//Execute Parent Constructor
		parent::__construct();
		//Check if not logged in
		if(!$this->auth->check()) {
			//Redirect to home
			redirect('/', 'location');
		}
		//Inject post repo in the controller
		$this->postsRepo = new PostRepository;
	}

	/**
	 *  Loads the profile page
	 *
	 * @param string $userId
	 *  @return string
	 */
	public function profile($userId)
	{

		try {
			//Get user for who this profile belongs
			$profileOwner = app('UserRepo')->getUser($userId, 'lecturer');
			//Lecturer profile was not found
			if($profileOwner == false) {
				//Show 404 page
				throw new Exception('Lecturer profile not found', '404');
			}

			//Get Posts
			$posts = $this->postsRepo->paginateUserPosts($profileOwner);
			//Get next page url
			$nextPageUrl = generate_next_page_url($posts);

			//This is a normal request
			if(!$this->input->is_ajax_request()) {
				//Load Student profile
				$this->load->view('lecturer-profile/timeline', [
					'title' => $profileOwner->full_name,
					'profileOwner' => $profileOwner,
					'posts' => $posts,
					'nextPageUrl' => $nextPageUrl,
					'profileMenu' => 1,
				]);
			} else {
				//Return json encoded data
				echo json_encode([
					'error' => false,
					'grid'  => $this->load->view('partials/_posts-grid', ['posts' => $posts], true),
					'nextPageUrl' => $nextPageUrl
				]);
			}
		} catch (Exception $e) {
			//Unexpected error
			//This is a normal request
			if(!$this->input->is_ajax_request()) {
				show_error($e->getMessage(), $e->getCode());
			} else {
				//Return error json
				echo json_encode([
					'error' => true,
					'message' => $e->getMessage()
				]);
			}
		}
	}

	/**
	 * Loads user about page
	 *
	 * @param int $userId
	 * @return string
	 */
	public function about($userId)
	{
		try {
			//Get user for who this profile belongs
			$profileOwner = app('UserRepo')->getUser($userId, 'lecturer');
			//Lecturer profile was not found
			if($profileOwner == false) {
				//Show 404 page
				throw new Exception('lLecturer profile not found', '404');
			}
			//Load about page
			$this->load->view('lecturer-profile/about', [
				'title' => $profileOwner->full_name,
				'profileOwner' => $profileOwner,
				'profileMenu' => 2,
			]);
		} catch (Exception $e) {
			//Unexpected error
			show_404();
		}
	}

	/**
	 * Loads user friends page
	 *
	 * @param int $userId
	 * @return string
	 */
	public function friends($userId)
	{
		try {
			//Get user for who this profile belongs
			$profileOwner = app('UserRepo')->getUser($userId, 'lecturer');
			//Lecturer profile was not found
			if($profileOwner == false) {
				//Show 404 page
				throw new Exception('Lecturer profile not found', '404');
			}
			//Load friends page
			$this->load->view('Lecturer-profile/friends', [
				'title' => $profileOwner->full_name,
				'profileOwner' => $profileOwner,
				'profileMenu' => 3,
			]);
		} catch (Exception $e) {
			//Unexpected error
			show_404();
		}
	}

	/**
	 * Show page to edit user basic info
	 *
	 * @param int $userId
	 * @return string
	 */
	public function showEditBasicInfo($userId)
	{
		try {
			//Get user for who this profile belongs
			$profileOwner = app('UserRepo')->getUser($userId, 'lecturer');
			//Lecturer profile was not found
			if($profileOwner == false || $profileOwner->isNot($this->auth->user())) {
				//Show 404 page
				throw new Exception('Lecturer profile not found', '404');
			}
			//Load Edit basic info page
			$this->load->view('lecturer-profile/edit-basic-info', [
				'title' => $profileOwner->full_name,
				'profileOwner' => $profileOwner,
				'profileMenu' => 2,
			]);

		} catch (Exception $e) {
			//Unexpected error
			show_404();
		}
	}




}