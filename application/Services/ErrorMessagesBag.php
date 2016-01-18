<?php

namespace App\Services;

/**
 * Class ErrorMessagesBag
 * @package App\Services
 */
class ErrorMessagesBag
{
	/**
	 * Create a new instance of the
	 * ErrorBag
	 */
	public function __construct()
	{}

	/**
	 * Keep validation errors for next redirect
	 *
	 * @return void
	 */
	public function logValidationErrors($fieldsNames = [])
	{
		//Get CI super object
		$ci = & get_instance();
		//Set error delimiter
		$ci->form_validation->set_error_delimiters('<small class="help-block server-error">', '</small>');
		//Loop through all fields and put error
		foreach($fieldsNames as $fieldsName) {
			//We have value for the field
			if(isset($_POST[$fieldsName]) && !empty($_POST[$fieldsName]) && $fieldsName != 'password') {
				//Put value in keeper
				$ci->keeper->put($fieldsName.'_value', $_POST[$fieldsName]);
			}
			//There is an error on the field
			if(form_error($fieldsName) != '') {
				//Keep error in the keeper
				$ci->keeper->put($fieldsName.'_error', form_error($fieldsName));
			}
		}
	}
}