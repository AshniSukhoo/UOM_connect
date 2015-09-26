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
        return false;
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


}