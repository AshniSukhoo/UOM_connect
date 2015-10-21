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

            //Load Student profile
            $this->load->view('pages/student-profile', [
                'title' => $profileOwner->full_name,
                'profileData' => $profileOwner,
            ]);

        } catch (Exception $e) {
            //Unexpected error
            show_404();
        }

    }

}