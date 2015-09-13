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

}