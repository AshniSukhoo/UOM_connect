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
			]);
		} catch (Exception $e) {
			//Unexpected error
			show_404();
		}
	}
}