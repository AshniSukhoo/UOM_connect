<?php

use App\Repositories\UserRepository;
use App\Services\ErrorMessagesBag;
use Carbon\Carbon;

/**
 * Class UserActionsController
 */
class UserActionsController extends MY_Controller
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
			if (!$this->auth->check()) {
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
			if ($this->form_validation->run() === false) {
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
				'emails'        => $this->input->post('emails') != null?collect(explode(',', $this->input->post('emails'))):'',
			]);

			//Info not saved
			if ($basicInfo == null) {
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
			if (!$this->auth->check()) {
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
			if ($this->form_validation->run() === false) {
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
			if ($newEducationRow == null) {
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
            if (!$this->auth->check()) {
                //Notify error
                $this->keeper->put('notificationError', 'You must log in to continue');
                //Return to login
                redirect('/login', 'location');
            }

            //Set validation rules
            $this->form_validation->set_rules('job_title', 'Job name', 'required|xss_clean');
            $this->form_validation->set_rules('company_name', 'Company name', 'required|xss_clean');
            $this->form_validation->set_rules('date_joined', 'Date Joined', 'required|xss_clean');

            //Apply validation rules
            if ($this->form_validation->run() === false) {
                //Keep error messages
                $this->errorBag->logValidationErrors([
                    'job_title',
                    'company_name',
	                'date_joined',
                ]);
                //Go back to  edit page user page
                redirect($this->auth->user()->profile_uri.'/add-work', 'location');
            }

            //Save info
            $newWorkRow = $this->userRepo->addWork($this->auth->user(), [
                'job_title'      => $this->input->post('job_title'),
                'company_name'   => $this->input->post('company_name'),
                'date_joined'    => Carbon::createFromFormat('d/m/Y', $this->input->post('date_joined'))->format('Y-m-d 00:00:00'),
                'date_left'      => ($this->input->post('date_left') != '' && $this->input->post('date_left') != null)?Carbon::createFromFormat('d/m/Y', $this->input->post('date_left'))->format('Y-m-d 00:00:00'):null,
                'is_current'     => ($this->input->post('date_left') == '')
            ]);

            //Info not saved
            if ($newWorkRow == null) {
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

	/**
	 * Saves info about edited education row
	 *
	 * @param string $educationId
	 * @return string
	 */
	public function saveEditedEducation($educationId = '')
	{
	    try {
	        //User must be logged in
			if (!$this->auth->check()) {
			    //Notify error
				$this->keeper->put('notificationError', 'You must log in to continue');
				//Return to login
				redirect('/login', 'location');
			}

			//Verify education edit capabilities
			if ($this->auth->user()->educations()->whereId($educationId)->count() != 1) {
			    //Cannot edit
				throw new Exception('You do not have permission to edit this record', 403);
			}

			//Set validation rules
			$this->form_validation->set_rules('institution_name', 'Institution name', 'required|xss_clean');
	        $this->form_validation->set_rules('major', 'Major', 'required|xss_clean');
	        $this->form_validation->set_rules('year_joined', 'Year started', 'required|xss_clean');

			//Apply validation rules
			if ($this->form_validation->run() === false) {
			    //Keep error messages
				$this->errorBag->logValidationErrors([
					'institution_name',
					'major',
					'year_joined'
				]);
				//Go back to  edit page user page
				redirect($this->auth->user()->profile_uri.'/edit-education/'.$educationId, 'location');
			}

			//Save the new education data
			$results = $this->userRepo->editEducation($this->auth->user(), $educationId, [
				'institution_name'  => $this->input->post('institution_name'),
				'major'             => $this->input->post('major'),
				'year_joined'       => $this->input->post('year_joined'),
				'year_left'         => $this->input->post('year_left'),
				'is_current'        => ($this->input->post('year_left') == '')
			]);

			//Could not save
			if ($results == null) {
			    //Alert error to user
				throw new Exception('Could not save data.Try again later', 422);
			}

			//Notify success
			$this->keeper->put('notificationSuccess', 'Education skills updated');

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
	 * Delete education row
	 *
	 * @param string $educationId
	 * @return string
	 */
	public function deleteEducation($educationId = '')
	{
	    try {
	        //User must be logged in
			if (!$this->auth->check()) {
			    //Notify error
				$this->keeper->put('notificationError', 'You must log in to continue');
				//Return to login
				redirect('/login', 'location');
			}

			//Verify education delete capabilities
			if ($this->auth->user()->educations()->whereId($educationId)->count() != 1) {
			    //Cannot edit
				throw new Exception('You do not have permission to edit this record', 403);
			}

			//Perform delete
			$results = $this->userRepo->deleteEducation($this->auth->user(), $educationId);

			//Could not delete
			if ($results == null) {
			    //Alert error to user
				throw new Exception('Could delete data.Try again later', 422);
			}

			//Notify success
			$this->keeper->put('notificationSuccess', 'Education skills deleted');

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
	 * Save an edited work item
	 *
	 * @param string $workId
	 * @return string
	 */
	public function saveEditedWork($workId = '')
	{
	    try {
	        //User must be logged in
			if (!$this->auth->check()) {
			    //Notify error
				$this->keeper->put('notificationError', 'You must log in to continue');
				//Return to login
				redirect('/login', 'location');
			}

			//Verify work edit capabilities
			if ($this->auth->user()->works()->whereId($workId)->count() != 1) {
			    //Cannot edit
				throw new Exception('You do not have permission to edit this record', 403);
			}

			//Set validation rules
			$this->form_validation->set_rules('job_title', 'Job name', 'required|xss_clean');
	        $this->form_validation->set_rules('company_name', 'Company name', 'required|xss_clean');
	        $this->form_validation->set_rules('date_joined', 'Date Joined', 'required|xss_clean');

			//Apply validation rules
			if ($this->form_validation->run() === false) {
			    //Keep error messages
				$this->errorBag->logValidationErrors([
					'job_title',
					'company_name',
					'date_joined',
				])->preserveInputs();
				//Go back to  edit page user page
				redirect($this->auth->user()->profile_uri.'/edit-work/'.$workId, 'location');
			}

			//Save the edited work data
			$results = $this->userRepo->editWork($this->auth->user(), $workId, [
				'job_title'      => $this->input->post('job_title'),
				'company_name'   => $this->input->post('company_name'),
				'date_joined'    => Carbon::createFromFormat('d/m/Y', $this->input->post('date_joined'))->format('Y-m-d 00:00:00'),
				'date_left'      => ($this->input->post('date_left') != '' && $this->input->post('date_left') != null)?Carbon::createFromFormat('d/m/Y', $this->input->post('date_left'))->format('Y-m-d 00:00:00'):null,
				'is_current'     => ($this->input->post('date_left') == '')
			]);

			//Could not save
			if ($results == null) {
			    //Alert error to user
				throw new Exception('Could not save data.Try again later', 422);
			}

			//Notify success
			$this->keeper->put('notificationSuccess', 'Work experience updated');

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
	 * Delete a work item
	 *
	 * @param string $workId
	 * @return string
	 */
	public function deleteWork($workId = '')
	{
	    try {
	        //User must be logged in
			if (!$this->auth->check()) {
			    //Notify error
				$this->keeper->put('notificationError', 'You must log in to continue');
				//Return to login
				redirect('/login', 'location');
			}

			//Verify work delete capabilities
			if ($this->auth->user()->works()->whereId($workId)->count() != 1) {
			    //Cannot edit
				throw new Exception('You do not have permission to delete this record', 403);
			}

			//Perform delete
			$results = $this->userRepo->deleteWork($this->auth->user(), $workId);

			//Could not delete
			if ($results == null) {
			    //Alert error to user
				throw new Exception('Could delete data.Try again later', 422);
			}

			//Notify success
			$this->keeper->put('notificationSuccess', 'Work experience deleted');

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
	 * Save user details
	 *
	 * @return string
	 */
	public function saveDetails()
	{
	    try {
	        //User must be logged in
			if (!$this->auth->check()) {
			    //Notify error
				$this->keeper->put('notificationError', 'You must log in to continue');
				//Return to login
				redirect('/login', 'location');
			}

			//Set validation rules
			$this->form_validation->set_rules('hobbies', 'Hobbies', 'required|xss_clean');
	        $this->form_validation->set_rules('interests', 'Interests', 'required|xss_clean');
	        $this->form_validation->set_rules('about', 'About', 'required|xss_clean');

			//Validation fails
			if ($this->form_validation->run() === false) {
			    //Keep error messages
				$this->errorBag->logValidationErrors([
					'hobbies',
					'interests',
					'about'
				])->preserveInputs();
				//Go back to  edit page user page
				redirect($this->auth->user()->profile_uri.'/add-edit-details/'.$workId, 'location');
			}

			//Save the user details
			$results = $this->userRepo->saveUserDetails($this->auth->user(), $_POST);

			//Could not save
			if ($results == null) {
			    //Alert error to user
				throw new Exception('Could save data.Try again later', 422);
			}

			//Notify success
			$this->keeper->put('notificationSuccess', 'Details saved');

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
	 * Send a new friend request to user
	 *
	 * @return string
	 */
	public function postAddFriend()
	{
	    try {
	        //User must be logged in
			if (!$this->auth->check()) {
			    //Notify error
				$this->keeper->put('notificationError', 'You must log in to continue');
				//Return to login
				redirect('/login', 'location');
			}

			//Set validation rules
			$this->form_validation->set_rules('user_id', 'User identifier', 'required|xss_clean');

			//Validation fails
			if ($this->form_validation->run() === false) {
			    //Raise exception
				throw new Exception('User identifier missing', 422);
			}

			//Send request
			$results = $this->userRepo->sendFriendRequest(
				$this->auth->user(),
				$this->userRepo->findUser($this->input->post('user_id'))
			);

			//Return results
			echo json_encode([
				'error' => !$results
			]);
	    } catch (Exception $e) {
	        //Unexpected error
			echo json_encode([
				'error'     => true,
				'message'   => $e->getMessage()
			]);
	    }
	}

	/**
	 * Cancel friend request
	 *
	 * @return string
	 */
	public function postCancelFriendRequest()
	{
	    try {
	        //User must be logged in
			if (!$this->auth->check()) {
			    //Notify error
				$this->keeper->put('notificationError', 'You must log in to continue');
				//Return to login
				redirect('/login', 'location');
			}

			//Set validation rules
			$this->form_validation->set_rules('user_id', 'User identifier', 'required|xss_clean');

			//Validation fails
			if ($this->form_validation->run() === false) {
			    //Raise exception
				throw new Exception('User identifier missing', 422);
			}

			//Send request
			$results = $this->userRepo->cancelFriendRequest(
				$this->auth->user(),
				$this->userRepo->findUser($this->input->post('user_id'))
			);

			//Return results
			echo json_encode([
				'error' => !$results
			]);
	    } catch (Exception $e) {
	        //Unexpected error
			echo json_encode([
				'error'     => true,
				'message'   => $e->getMessage()
			]);
	    }
	}

	/**
	 * Accept a friend request
	 * 
	 * @return string
	 */
	public function postAcceptFriendRequest()
	{
        try {
            //User must be logged in
            if (!$this->auth->check()) {
                //Notify error
                $this->keeper->put('notificationError', 'You must log in to continue');
                //Return to login
                redirect('/login', 'location');
            }

            //Set validation rules
            $this->form_validation->set_rules('user_id', 'User identifier', 'required|xss_clean');

            //Validation fails
            if ($this->form_validation->run() === false) {
                //Raise exception
                throw new Exception('User identifier missing', 422);
            }

            //Perform accept friend request
            $results = $this->userRepo->acceptFriendRequest(
                $this->auth->user(),
                $this->userRepo->findUser($this->input->post('user_id'))
            );

            //Return results
            echo json_encode([
                'error' => !$results
            ]);
        } catch (Exception $e) {
            //Unexpected error
            echo json_encode([
                'error'     => true,
                'message'   => $e->getMessage()
            ]);
        }
	}
}
