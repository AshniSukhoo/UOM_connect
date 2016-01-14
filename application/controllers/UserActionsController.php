<?php

/**
 * Class UserActionsController
 */
class UserActionsController extends CI_Controller
{

	/**
	 * Create new instance of UserActionsController
	 */
	public function __construct()
	{
		//Call parent construct
		parent::__construct();
	}

	/**
	 * Save the basic info for student
	 *
	 * @return string
	 */
	public function saveBasicInfo()
	{
		try {
			dd($_POST);
		} catch (Exception $e) {

		}
	}
}