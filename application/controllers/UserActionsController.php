<?php

use App\Repositories\UserRepository;
use App\Services\ErrorMessagesBag;

/**
 * Class UserActionsController
 */
class UserActionsController extends CI_Controller
{
	/**
	 * The user repo service
	 *
	 * @var \App\Repositories\UserRepository
	 */
	protected $userRepo;

	/**
	 * The error bag service
	 *
	 * @var \App\Services\ErrorMessagesBag
	 */
	protected $errorBag;

	/**
	 * Create new instance of UserActionsController
	 */
	public function __construct()
	{
		//Call parent construct
		parent::__construct();
		//Inject user repo in controller
		$this->userRepo = new UserRepository();
		//Inject bag in controller
		$this->errorBag = new ErrorMessagesBag();
	}

	/**
	 * Save the basic info for student
	 *
	 * @return string
	 */
	public function saveBasicInfo()
	{
		try {
			//User must be logged in
			if(!$this->auth->check()) {
				//Notify error
				$this->keeper->put('notificationError', 'You must log in to continue');
				//Return to login
				redirect('/login', 'location');
			}

			//Set validation rules
			$this->form_validation->set_rules('country', 'Country', 'required|xss_clean');
			$this->form_validation->set_rules('city', 'City', 'required|xss_clean');
			$this->form_validation->set_rules('address', 'Address', 'required|xss_clean');

			//Apply validation rules
			if($this->form_validation->run() === false) {
				//Keep error messages
				$this->errorBag->logValidationErrors([
					'country',
					'city',
					'address'
				]);
				//Go back to  edit page user page
				redirect($this->auth->user()->profile_uri.'/edit-basic-info', 'location');
			}

			//Save user basic info
			$basicInfo = $this->userRepo->saveBasicInfo($this->auth->user(), [
				'address'       => $this->input->post('address'),
				'city'          => $this->input->post('city'),
				'country'       => $this->input->post('country'),
				'phone_number'  => $this->input->post('phone_number') != null?$this->input->post('phone_number'):'',
				'emails'        => $this->input->post('emails') != null?collect(explode(',',$this->input->post('emails'))):'',
			]);

			//Info not saved
			if($basicInfo == null) {
				//Alert error to user
				throw new Exception('Could not data.Try again later', 422);
			}

			//All ok redirect to User profile
			redirect($this->auth->user()->profile_uri.'/about', 'location');
		} catch (Exception $e) {
			//Unexpected error
			//Notify error
			$this->keeper->put('notificationError', $e->getMessage());
			//Go back to profile page
			redirect($this->auth->user()->profile_uri.'/about', 'location');
		}
	}
}