<?php

/**
 * Class Keeper
 */
class Keeper
{
    /**
     * CI super object
     *
     * @var
     */
    protected $ci;

    /**
     * The keeper key of the session
     *
     * @var string
     */
    protected $keeperKey = 'keeper';

    /**
     * Create Keeper Instance
     */
    public function __construct()
    {
        //Get CI super object
        $this->ci = & get_instance();

    }

    /**
     * Put an item in the keeper
     *
     * @param $key
     * @param $value
     * @param bool|false $longTerm
     */
    public function put($key, $value, $longTerm = false)
    {
        try {
            //Save to user data if long term
            if($longTerm) {
                //Set user data
                $this->ci->session->set_userdata($key, $value);
            }
            //Only for one request
            else {
                $this->ci->session->set_flashdata($key, $value);
            }
            //Return true to finish
            return true;
        }
        //Unexpected error
        catch(Exception $e) {
            //Simply return false
            return false;
        }
    }

    /**
     * Get item from keeper
     *
     * @param $key
     */
    public function get($key)
    {
        try {
            //Try get the data from session userdata first
            $data = $this->ci->session->userdata($key);
            //We did not get data
            if($data === false) {
                //Try get from flash
                $data = $this->ci->session->flashdata($key);
            }
            //Return the data
            return $data;
        }
        //Unexpected error
        catch(Exception $e) {
            //Simply return false
            return false;
        }

    }

    /**
     * Check if we have item in the keeper
     *
     * @param string $key
     */
    public function has($key)
    {
        try {
            //Try get the data from session userdata first
            $data = $this->ci->session->userdata($key);
            //We did not get data
            if($data === false) {
                //Try get from flash
                $data = $this->ci->session->flashdata($key);
            }
            //Return the data
            return ($data === false)?false:true;
        }
        //Unexpected error
        catch(Exception $e) {
            //we return false
            return false;
        }

    }

}