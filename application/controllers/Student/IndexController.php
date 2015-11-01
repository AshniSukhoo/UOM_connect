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
     * @param integer $userId
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

}