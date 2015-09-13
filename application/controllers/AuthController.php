<?php


/**
 * Class AuthController
 */
Class AuthController extends MY_Controller
{


    /**
     * Create new instance of AuthController
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Performs a user registration
     *
     */
    public function signUp()
    {
        try {

            //Set the validation rules
            $this->form_validation->set_rules('firstName', 'First name', 'required|alpha|xss_clean');
            $this->form_validation->set_rules('lastName', 'Last name', 'required|alpha|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_unique_email|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|xss_clean');
            $this->form_validation->set_rules('confirmPassword', 'Password confirmation', 'required|min_length[5]|matches[password]|xss_clean');
            $this->form_validation->set_rules('userType', 'User type', 'required|xss_clean');
            $this->form_validation->set_rules('DOBDay', 'Birthday\'s day', 'required|xss_clean');
            $this->form_validation->set_rules('DOBMonth', 'Birthday\'s month', 'required|xss_clean');
            $this->form_validation->set_rules('DOBYear', 'Birthday\'s year', 'required|xss_clean');
            $this->form_validation->set_rules('gender', 'Gender', 'required|xss_clean');
            $this->form_validation->set_rules('uomId', 'UOM ID', 'required|numeric|callback_check_uom_id['.$this->input->post('userType').']|xss_clean');

            //Run the validation rules
            if($this->form_validation->run() === false) {
                //Our form is not valid, so sad!!
                echo validation_errors();
            }
            else {
                echo 'Hurray!!!.. You have passed my validation dude';
            }


        }
        //Unexpected error or unknown error
        catch(Exception $e) {
        }

    }

    /**
     * Performs a user login
     */
    public function login()
    {

    }


}