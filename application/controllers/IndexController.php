<?php

/**
 * Class IndexController
 */
class IndexController extends MY_Controller {

    /**
     * Create Index controller
     * instance
     */
    public function __construct() {
        try {
            //Execute parent constructor
            parent::__construct();

        }
        //Unexpected error or unknown error
        catch(Exception $e) {

        }
    }


    public function index() {
        $this->load->view('login');
    }
}