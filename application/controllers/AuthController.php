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
                //Define list of fields
                $fieldNames = [
                    'firstName', 'lastName', 'email', 'password', 'confirmPassword', 'userType',
                    'DOBDay', 'DOBMonth', 'DOBYear', 'gender', 'uomId'
                ];
                //Set error delimiter
                $this->form_validation->set_error_delimiters('<small class="help-block server-error">', '</small>');
                //Loop through all fields and put error
                foreach($fieldNames as $fieldName) {
                    //We have value for the field
                    if(isset($_POST[$fieldName]) && !empty($_POST[$fieldName]) && $fieldName != 'password' && $fieldName != 'confirmPassword') {
                        //Put value in keeper
                        $this->keeper->put($fieldName.'_value', $_POST[$fieldName]);
                    }
                    //There is an error on the field
                    if(form_error($fieldName) != '') {
                        //Keep error in the keeper
                        $this->keeper->put($fieldName.'_error', form_error($fieldName));
                    }
                }
                //Redirect on login-register page
                redirect('/');
            } else {
                //Validation has passed.
                //Save details in database
                //Build array with data to be inserted in users table
                $userDataToInsert = [
                    'first_name' => $this->input->post('firstName'),
                    'last_name' => $this->input->post('lastName'),
                    'email' => $this->input->post('email'),
                    'password' => $this->auth->encryptPassword($this->input->post('password')),
                    'user_type' => $this->input->post('userType'),
                    'date_of_birth' => $this->input->post('DOBYear').'-'.$this->input->post('DOBMonth').'-'.$this->input->post('DOBDay'),
                    'gender' => $this->input->post('gender'),
                    'uom_id' => $this->input->post('uomId'),
                    'account_status' => 2,
                    'datetime_joined' => date('Y-m-d H:i:s')
                ];
                //Save the new details
                $newUserId = $this->User->saveNewUser($userDataToInsert);
                //Generate a new token
                $token = $this->auth->generateVerificationToken($this->input->post('email'));
                //Build data to be inserted in account_verification_tokens
                $tokenData = [
                    'user_id' => $newUserId,
                    'token' => $token,
                    'status' => 'active',
                    'created_at' => date('Y-m-d H:i:s')
                ];
                //Save token
                $this->User->saveToken($tokenData);

                //We must send email for confirmation of account
                //Basic email data
                $this->email->from('registration@uom-connect.mu', 'UOM-Connect');
                $this->email->to($this->input->post('email'));
                $this->email->subject('Welcome to UOM-Connect');

                //Start building data to go on email
                $emailData = [
                    'fullName' => $userDataToInsert['first_name'].' '.$userDataToInsert['last_name'],
                    'comfirmationLink' => base_url().'verify-account?key='.$token,
                    'title' => 'Welcome to UOM-Connect',
                    'intro' => 'Your Confirmation to UOM-Connect'
                ];
                //Email message
                $message = $this->load->view('emails/account-confirmation-email', $emailData, true);
                $this->email->message($message);
                $this->email->send();

                //Notify user that account has been created
                $notif = 'Your account has been created successfully. We have send you an email, click on the link in the email to activate your account.';
                $this->keeper->put('notificationSuccess', $notif);
                //Redirect on login-register page
                redirect('/');
            }
        } catch(Exception $e) {
            //Unexpected error or unknown error
            //Notify error
            $this->keeper->put('notificationError', $e->getMessage());
            //Redirect on login-register page
            redirect('/');
        }
    }

    /**
     * Confirm user account from
     * confirmation link
     * @return void
     */
    public function confirmAccount()
    {
        echo 'Confirm my account please.';
        echo '<br/>';
        echo 'My Key is:'.$this->input->get('key');
    }

    /**
     * Show login page
     */
    public function getLogin()
    {
        try {
            //We must not show navigation login form
            $data['noNavLogin'] = true;

            //Load login page
            $this->load->view('auth/dedicated-login', $data);
        } catch (Exception $e) {
            //Unexpected error
            show_404();
        }
    }

    /**
     * Logout from application
     * @return void
     */
    public function getLogout()
    {
        try {
            //Log user out
            $this->auth->logout();
            //Redirect back to home page
            redirect('/', 'location');
        } catch(Exception $e) {
            //Unexpected error
            show_404();
        }
    }

    /**
     * Performs a user login
     */
    public function postLogin()
    {
		try{
			//Set validation rules
			$this->form_validation->set_rules('login_email', 'Email', 'required|valid_email|xss_clean');
            $this->form_validation->set_rules('login_password', 'Password', 'required|min_length[5]|xss_clean');
			
			//Run validation rules
            if($this->form_validation->run() === false) {
                //Our form is not valid
                //Define list of fields
                $fieldsNames = [
                    'login_email', 'login_password'
                ];
                //Set error delimiter
                $this->form_validation->set_error_delimiters('<small class="help-block server-error">', '</small>');
                //Loop through all fields and put error
				 foreach($fieldsNames as $fieldsName) {
                    //We have value for the field
                    if(isset($_POST[$fieldsName]) && !empty($_POST[$fieldsName]) && $fieldsName != 'password') {
                        //Put value in keeper
                        $this->keeper->put($fieldsName.'_value', $_POST[$fieldsName]);
                    }
                    //There is an error on the field
                    if(form_error($fieldsName) != '') {
                        //Keep error in the keeper
                        $this->keeper->put($fieldsName.'_error', form_error($fieldsName));
                    }
                }
				//Redirect on login-register page
                redirect('/login', 'location');
            } else {
                //Validation has passed.
                //Get user credentials
                $credentials = [
                    'email' => $this->input->post('login_email'),
                    'password' => $this->input->post('login_password')
                ];
                //Check whether user has checked keep alive checkbox
                $keepAlive = ($this->input->post('rememberMe') == 'yes')?true:false;
                //Attempt to login user in
                $loginAttempt = $this->auth->attempt($credentials, $keepAlive);
                //Attemps was a success
                if($loginAttempt['status']) {
                    //Redirect to Home page
                    redirect('/', 'location');
                } else {
                    //Failed login
                    //put email value in keeper
                    $this->keeper->put('login_email_value', $credentials['email']);
                    //Put error message Login in keeper
                    $this->keeper->put('error_msg_login', $loginAttempt['error']);
                    //Redirect to login
                    redirect('login', 'location');
                }
            }
		} catch(Exception $e){
            //Unexpected error or unknown error
			//Notify error
            $this->keeper->put('notificationError', $e->getMessage());
            //Redirect on login-register page
            redirect('/');
		}
    }
}
