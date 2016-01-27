<?php

namespace App\Services;

/**
 * Class ErrorMessagesBag
 * @package App\Services
 */
class ErrorMessagesBag
{
	/**
	 * Fields names we are processing
	 *
	 * @var array
	 */
	protected $fieldNames = [];

	/**
	 * Create a new instance of the
	 * ErrorBag
	 */
	public function __construct()
	{}

	/**
	 * Keep validation errors for next redirect
	 *
	 * @param array $fieldsNames
	 * @return \App\Services\ErrorMessagesBag
	 */
	public function logValidationErrors($fieldsNames = [])
	{
		//Get CI super object
		$ci = & get_instance();
		//Add field names to attribute
		$this->fieldNames = $fieldsNames;
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
		//Return error bag
		return $this;
	}

	/**
	 * Preserve inputs on fields
	 *
	 * @return \App\Services\ErrorMessagesBag
	 */
	public function preserveInputs()
	{
		//Get CI super object
		$ci = & get_instance();
		//We have fields
		if(!empty($this->fieldNames)) {
			//Loop through all fields and put error
			foreach($this->fieldNames as $fieldName) {
				//We have value for the field
				if(isset($_POST[$fieldName]) && !empty($_POST[$fieldName]) && $fieldName != 'password' && $fieldName != 'confirmPassword') {
					//Put value in keeper
					$ci->keeper->put($fieldName.'_value', $_POST[$fieldName]);
				}
				//There is an error on the field
				if(form_error($fieldName) != '') {
					//Keep error in the keeper
					$ci->keeper->put($fieldName.'_error', form_error($fieldName));
				}
			}
		}
		//return error bag
		return $this;
	}
}