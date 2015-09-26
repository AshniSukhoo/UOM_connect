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
            }
            //Validation has passed.
            else {
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
                $this->email->subject('Confirm your account');

                //Email message
                $message = '<a href="'.base_url().'verify-account?key='.$token.'">Click here to verify account</a>';
                $this->email->message($message);
                $this->email->send();

                //Notify user that account has been created
                $notif = 'Your account has been created successfully. We have send you an email, click on the link in the email to activate your account.';
                $this->keeper->put('notificationSuccess', $notif);
                //Redirect on login-register page
                redirect('/');
            }
        }
        //Unexpected error or unknown error
        catch(Exception $e) {
            //Notify error
            $this->keeper->put('notificationError', $e->getMessage());
            //Redirect on login-register page
            redirect('/');
        }
    }

    /**
     * Performs a user login
     */
    public function login()
    {

    }


}