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



        } catch (Exception $e) {
            //Unexpected error
            show_404();
        }

    }

}