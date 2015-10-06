<?php

/**
 * Class User
 */
class User extends CI_Model
{
    /**
     * Checks if email is in database
     *
     * @param string $email
     * @return bool
     */
    public function checkEmail($email = '')
    {
        try {
            //Construct the query
            $sql = "SELECT * FROM users WHERE email = ".$this->db->escape($email);
            //Execute the query
            $query = $this->db->query($sql);
            //CHeck the number of rows
            if($query->num_rows() == 0){
                //No rows found which means the email does not exists
                //So we return false
                return false;
            }
            //We found some rows so the email exists already
            else {
                //So we return true
                return true;
            }
        }
        //Unexpected error
        catch(Exception $e) {
            //We simply return false
            return false;
        }
    }

    /**
     * Retrieve user row using email
     *
     * @param string $email
     * @return stdClass|bool
     */
    public function retrieveUserByEmail($email = '')
    {
        try {
            //Build SQL
            $sql = 'SELECT * FROM users WHERE email = '.$this->db->escape($email);
            //Execute SQL
            $query = $this->db->query($sql);
            //Count number of rows found
            if($query->num_rows() > 0) {
                //Return the row
                return $query->row();
            } else {
                //No rows found
                return false;
            }
        } catch(Exception $e) {
            //Unexpected error
            //simply return false
            return false;
        }
    }

    /**
     * Retrieve a user account using the Remember me token
     *
     * @param string $token
     * @return stdClass|bool
     */
    public function retrieveUserByRememberToken($token)
    {
        try {
            //Build SQL
            $sql = "SELECT * FROM users WHERE remember_me = ".$this->db->escape($token);
            //Execute the query
            $query = $this->db->query($sql);
            //No user found with this token
            if($query->num_rows() == 0) {
                //return false
                return false;
            }
            //Return the user account
            return $query->row();
        } catch (Exception $e) {
            //Unexpected error
            //Simply return false
            return false;
        }
    }


    /**
     * Updates the remember me token in the user table
     *
     * @param int $userId
     * @param string $token
     */
    public function updateRememberMeToken($userId, $token)
    {
        //Update the field remember_me where User id matches
        $this->db->where('id', $userId);
        $this->db->update('users', ['remember_me' => $token]);
    }

    /**
     * Checks if the id is valid
     * for the opening a new account
     *
     * @param string $id
     */
    public function checkValidUOMID($id = '',$type = '')
    {
        try {

            //Construct query
            $sql = "SELECT * FROM uom_valid_ids
                    WHERE id = ".$this->db->escape($id)."
                    AND type = ".$this->db->escape($type)."
                    AND valide = '1' AND has_account = '0'";

            //Execute our query
            $query = $this->db->query($sql);

            //We got a valid row, ID is valid
            if($query->num_rows() == 1){
                //We return true
                return true;
            }
            //No rows found so the id is not valid
            else {
                //So we return false
                return false;
            }
        }
        //Unexpected error
        catch(Exception $e) {
            //We simply return false
            return false;
        }
    }

    /**
     * Saves a new user details
     *
     * @param array $data
     * @return int
     */
    public function saveNewUser($data = [])
    {
        //Save new user record
        $this->db->insert('users', $data);
        //Return the new User Id
        return $this->db->insert_id();
    }

    /**
     * Save new account verification token
     *
     * @param array $data
     * @return void
     */
    public function saveToken($data = [])
    {
        //Save new user record
        $this->db->insert('account_verification_tokens', $data);
    }

}