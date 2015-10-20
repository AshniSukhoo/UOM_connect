<?php

namespace App\Repositories;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Eloquent\User;
use Exception;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * The Eloquent User
     *
     * @var \App\Eloquent\User
     */
    protected $user;

    /**
     * Create a new instance of
     * UserRepository
     */
    public function __construct()
    {
        //Inject User Model into class
        $this->user = new User;
    }

    /**
     * Get a single User using
     * his user ID and user type
     *
     * @param $userId
     * @param $type
     * @return \App\Eloquent\User|null
     */
    public function getUser($userId, $type)
    {
        try {
            //Try to find the user with the ID and type specified
            $user = $this->user->where('user_type', '=', $type)->findOrFail($userId);
            //Return the user
            return $user;
        } catch (Exception $e) {
            //Unexpected error
            return null;
        }
    }

}