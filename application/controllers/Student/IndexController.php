<?php

/**
 * Class IndexController
 */
class IndexController extends MY_Controller
{
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
    }

    /**
     * Loads the profile page
     *
     * @param int $userId
     * @return string
     */
    public function profile($userId)
    {
        try {
            //Get user for who this profile belongs
            $profileOwner = app('UserRepo')->getUser($userId, 'student');
            //Student profile was not found
            if($profileOwner == false) {
                //Show 404 page
                throw new Exception('Student profile not found', '404');
            }
            //Load Student profile
            $this->load->view('student-profile/timeline', [
                'title' => $profileOwner->full_name,
                'profileOwner' => $profileOwner,
                'profileMenu' => 1,
            ]);
        } catch (Exception $e) {
            //Unexpected error
            show_404();
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
            $profileOwner = app('UserRepo')->getUser($userId, 'student');
            //Student profile was not found
            if($profileOwner == false) {
                //Show 404 page
                throw new Exception('Student profile not found', '404');
            }
            //Load about page
            $this->load->view('student-profile/about', [
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
            $profileOwner = app('UserRepo')->getUser($userId, 'student');
            //Student profile was not found
            if($profileOwner == false) {
                //Show 404 page
                throw new Exception('Student profile not found', '404');
            }
            //Load friends page
            $this->load->view('student-profile/friends', [
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
            $profileOwner = app('UserRepo')->getUser($userId, 'student');
            //Student profile was not found
            if($profileOwner == false || $profileOwner->isNot($this->auth->user())) {
                //Show 404 page
                throw new Exception('Student profile not found', '404');
            }
            //Load Edit basic info page
            $this->load->view('student-profile/edit-basic-info', [
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
	 * Show page to education to user student profile
	 *
	 * @param $userId
	 * @return string
	 */
	public function showAddEducation($userId)
	{
		try {
			//Get user for who this profile belongs
			$profileOwner = app('UserRepo')->getUser($userId, 'student');
			//Student profile was not found
			if($profileOwner == false || $profileOwner->isNot($this->auth->user())) {
				//Show 404 page
				throw new Exception('Student profile not found', '404');
			}
			//Load Edit basic info page
			$this->load->view('student-profile/add-education', [
				'title' => $profileOwner->full_name,
				'profileOwner' => $profileOwner,
				'profileMenu' => 2,
				'handle' => 'add',
			]);
		} catch (Exception $e) {
			//Unexpected error
			show_404();
		}
	}

	/**
	 * Show the page to edit education row
	 *
	 * @param $userId
	 * @param $educationId
	 * @return string
	 */
	public function showEditEducation($userId, $educationId)
	{
		try {
			//Get user for who this profile belongs
			$profileOwner = app('UserRepo')->getUser($userId, 'student');
			//Student profile was not found
			if($profileOwner == false || $profileOwner->isNot($this->auth->user())) {
				//Show 404 page
				throw new Exception('Student profile not found', '404');
			}
			//Load Edit basic info page
			$this->load->view('student-profile/add-education', [
				'title' => $profileOwner->full_name,
				'profileOwner' => $profileOwner,
				'profileMenu' => 2,
				'handle' => 'edit',
				'education' => $profileOwner->educations()->findOrFail($educationId),
			]);
		} catch (Exception $e) {
			//Unexpected error
			show_404();
		}
	}

    /**
     * Show page to work to user student profile
     *
     * @param $userId
     * @return string
     */
    public function showAddWork($userId)
    {
        try {
            //Get user for who this profile belongs
            $profileOwner = app('UserRepo')->getUser($userId, 'student');
            //Student profile was not found
            if($profileOwner == false || $profileOwner->isNot($this->auth->user())) {
                //Show 404 page
                throw new Exception('Student profile not found', '404');
            }
            //Load Edit basic info page
            $this->load->view('student-profile/add-work', [
                'title' => $profileOwner->full_name,
                'profileOwner' => $profileOwner,
                'profileMenu' => 2,
	            'handle' => 'add',
            ]);
        } catch (Exception $e) {
            //Unexpected error
            show_404();
        }
    }

	/**
	 * Show page to edit a work item
	 *
	 * @param string $userId
	 * @param string $workId
	 * @return string
	 */
	public function showEditWork($userId, $workId)
	{
		try {
			//Get user for who this profile belongs
			$profileOwner = app('UserRepo')->getUser($userId, 'student');
			//Student profile was not found
			if($profileOwner == false || $profileOwner->isNot($this->auth->user())) {
				//Show 404 page
				throw new Exception('Student profile not found', '404');
			}
			//Load Edit basic info page
			$this->load->view('student-profile/add-work', [
				'title' => $profileOwner->full_name,
				'profileOwner' => $profileOwner,
				'profileMenu' => 2,
				'handle' => 'edit',
				'work' => $profileOwner->works()->findOrFail($workId),
			]);
		} catch (Exception $e) {
			//Unexpected error
			show_404();
		}
	}

	/**
	 * Show page to add or edit user details
	 *
	 * @param string $userId
	 * @return string
	 */
	public function addEditDetails($userId)
	{
		try {
			//Get user for who this profile belongs
			$profileOwner = app('UserRepo')->getUser($userId, 'student');
			//Student profile was not found
			if($profileOwner == false || $profileOwner->isNot($this->auth->user())) {
				//Show 404 page
				throw new Exception('Student profile not found', '404');
			}
			//Load page to add or edit details
			$this->load->view('student-profile/add-edit-details', [
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