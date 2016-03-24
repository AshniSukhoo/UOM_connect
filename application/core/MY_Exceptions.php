<?php

/**
 * Class MY_Exceptions
 */
class MY_Exceptions extends CI_Exceptions
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 404 Page Not Found Handler
     *
     * @access	private
     * @param	string	the page
     * @param 	bool	log error yes/no
     * @return	string
     */
    function show_404($page = '', $log_error = TRUE)
    {
        $CI =& get_instance();
        $CI->load->view('errors/404');
        echo $CI->output->get_output();
        exit;
    }
}
