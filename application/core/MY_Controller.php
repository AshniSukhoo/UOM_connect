<?php

/**
 * Class MY_Controller
 */
class MY_Controller extends CI_Controller
{

    /**
     * Create MY_Controller instance
     * class
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
     * Checks if email is not
     * already in use
     *
     * @param string $email
     */
    public function check_unique_email($email = '')
    {
        try {

            //No email passed to the function
            if($email == '') {
                //Stop and return false
                throw new Exception('No email passed the check email function', '400');
            }

            //Email exists already
            if($this->User->checkEmail($email)) {
                //Set form validation error
                $this->form_validation->set_message('check_unique_email', 'This %s is already attached to an account, please choose another email.');
                //then we return false
                return false;
            }

            //All seems good so we return true
            return true;
        }
        //Unexpected error
        catch(Exception $e) {
            //So we return false
            return false;
        }

    }

    /**
     * Checks if the UOM ID is
     * valid identifier
     *
     * @param string $id
     * @param string $type
     * @return bool
     */
    public function check_uom_id($id = '', $type = '')
    {
        try {

            //No parameters passed
            if($id == '' || $type == '') {
                //Stop and alert error
                throw new Exception('No parameters passed to check uom id', '400');
            }

            //ID is valid
            if($this->User->checkValidUOMID($id,$type)) {
                //So we gladly return true
                return true;
            }
            //Oh boy!! not a valid ID
            else {
                //Set form validation error
                $this->form_validation->set_message('check_uom_id', 'Unfortunately, the UOM ID that you have provided could not be verified.');
                //then we return false
                return false;
            }
        }
        //Unexpected error
        catch (Exception $e) {
            //simply return false
            return false;
        }

    }

}