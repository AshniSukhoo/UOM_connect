<?php


/**
 * Class Auth
 */
class Auth
{
    /**
     * The encryption key to use
     *
     * @var string
     */
    private $encryptionKey = 'TkxFC5ygnpMKvWCY3jT6VSYx5yJMPHtQ';

    /**
     * Create auth instance
     */
    public function __construct()
    {

    }

    /**
     * Will tell us if user
     * is logged in or not
     *
     * @return bool
     */
    public function check()
    {
        try {
            //Get CI super Object
            $ci = & get_instance();
            //Check if We have logged_in_user in Keeper
            if($ci->keeper->has('logged_in_user')) {
                //Return true
                return true;
            } else {
                //Verify conn_id cookie
                $conn_id = $ci->input->cookie('conn_id', true);
                //Conn id not found
                if($conn_id == false) {
                    //return false
                    return false;
                }
                //We go the remember me token
                $userAccount = $ci->User->retrieveUserByRememberToken($conn_id);
                //We got the user account
                if($userAccount != false) {
                    //Re-start uom_session
                    $ci->keeper->put('logged_in_user', $userAccount->id, true);
                    //Return true
                    return true;
                } else {
                    //Delete conn cookie
                    delete_cookie('conn_id');
                    //return false
                    return false;
                }
            }
        } catch (Exception $e) {
            //Unexpected error
            //Simply return false
            return false;
        }
    }

    /**
     * Will encrypt a password and return
     * the encrypted form of the password
     *
     * @param string $passwordPlain
     * @return string
     */
    public function encryptPassword($passwordPlain = '')
    {
        //Return one way encryption of the password
        return sha1(sha1($passwordPlain).$this->encryptionKey);
    }


    /**
     * Generate a token depending on
     * a base
     *
     * @param string $base
     * @return string
     */
    public function generateVerificationToken($base = '')
    {
        //Return the token
        return sha1(mt_rand(10000,99999).time().$base);
    }

    /**
     * Function to validate the password
     *
     * @param $userAccount
     * @param $passwordPlain
     */
    private function validate($userAccount, $passwordPlain)
    {
        //Return true or false if password matches
        return $userAccount->password == $this->encryptPassword($passwordPlain);
    }

    /**
     * Attemps a user login
     *
     * @param array $credentials
     * @param bool|false $keepAlive
     * @return array
     */
    public function attempt($credentials = [], $keepAlive = false)
    {
        try {
            //Get CI super object
            $ci = & get_instance();
            //Retrieve user account
            $userAccount = $ci->User->retrieveUserByEmail($credentials['email']);
            //Could not find user account
            if($userAccount == false) {
                //Stop and return false
                throw new Exception('Email address is not associated with any account', '404');
            }
            //Account was found
            //Account not active
            if($userAccount->account_status != 1) {
                //Stop and return false
                throw new Exception('Your account is not confirmed yet, please click on the confirmation link that you have recieved in your email inbox', '403');
            }
            //Validate entered password
            if(!$this->validate($userAccount, $credentials['password'])) {
                //Stop and alert incorrect password
                throw new Exception('The password you entered is incorrect', '401');
            }
            //Password is OK start session for the user
            $ci->keeper->put('logged_in_user', $userAccount->id, true);
            //User has checked keep alive box
            if($keepAlive) {
                //Generate remember_me token
                $rememberMeToken = $this->generateVerificationToken($userAccount->email);
                //Set cookie connection
                $ci->input->set_cookie('conn_id', $rememberMeToken, '31536000');
                //Updated the remember_me field in the user table
                $ci->User->updateRememberMeToken($userAccount->id, $rememberMeToken);
            }
            //Return success of the function
            return [
                'status' => true,
            ];
        } catch(Exception $e) {
            //Unexpected error
            //Return error
            return [
                'status' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}