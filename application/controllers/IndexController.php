<?php

/**
 * Class IndexController
 */
class IndexController extends MY_Controller
{

    /**
     * Create Index controller
     * instance
     */
    public function __construct()
    {
        try {
            //Execute parent constructor
            parent::__construct();
        }
        //Unexpected error or unknown error
        catch(Exception $e) {

        }
    }

    /**
     * Load the Home page or Login/Registration page
     */
    public function index()
    {
        //User is logged in
        if($this->auth->check()) {

            echo 'Heyyy you are logged in';

        } else {
            //Load login/Registration page
            $this->load->view('login');
        }
    }
}