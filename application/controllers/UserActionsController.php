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
				throw new Exception('Could not save data.Try again later', 422);
			}

			//Notify success
			$this->keeper->put('notificationSuccess', 'Basic info saved');

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

	/**
	 * Save new education information for a user
	 *
	 * @return string
	 */
	public function saveNewEducation()
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
			$this->form_validation->set_rules('institution_name', 'Institution name', 'required|xss_clean');
			$this->form_validation->set_rules('major', 'Major', 'required|xss_clean');
			$this->form_validation->set_rules('year_joined', 'Year started', 'required|xss_clean');

			//Apply validation rules
			if($this->form_validation->run() === false) {
				//Keep error messages
				$this->errorBag->logValidationErrors([
					'institution_name',
					'major',
					'year_joined'
				]);
				//Go back to  edit page user page
				redirect($this->auth->user()->profile_uri.'/add-education', 'location');
			}

			//Save info
			$newEducationRow = $this->userRepo->addEducation($this->auth->user(), [
				'institution_name'  => $this->input->post('institution_name'),
				'major'             => $this->input->post('major'),
				'year_joined'       => $this->input->post('year_joined'),
				'year_left'         => $this->input->post('year_left'),
				'is_current'        => ($this->input->post('year_left') == '')
			]);

			//Info not saved
			if($newEducationRow == null) {
				//Alert error to user
				throw new Exception('Could not save data.Try again later', 422);
			}

			//Notify success
			$this->keeper->put('notificationSuccess', 'New education added');

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

    /**
     * Save new work information for a user
     *
     * @return string
     */
    public function saveNewWork()
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
            $this->form_validation->set_rules('job_title', 'Job name', 'required|xss_clean');
            $this->form_validation->set_rules('company_name', 'Company name', 'required|xss_clean');

            //Apply validation rules
            if($this->form_validation->run() === false) {
                //Keep error messages
                $this->errorBag->logValidationErrors([
                    'job_title',
                    'company_name',
                ]);
                //Go back to  edit page user page
                redirect($this->auth->user()->profile_uri.'/add-work', 'location');
            }

            //Save info
            $newWorkRow = $this->userRepo->addWork($this->auth->user(), [
                'job_title'      => $this->input->post('job_title'),
                'company_name'   => $this->input->post('company_name'),
                'date_joined'    => $this->input->post('date_joined'),
                'date_left'         => $this->input->post('date_left'),
                'is_current'        => ($this->input->post('date_left') == '')
            ]);

            //Info not saved
            if($newWorkRow == null) {
                //Alert error to user
                throw new Exception('Could not save data.Try again later', 422);
            }

            //Notify success
            $this->keeper->put('notificationSuccess', 'New work details added');

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