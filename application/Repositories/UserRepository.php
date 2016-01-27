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
            //User is not found
            if($user == null) {
                //We return false
                return false;
            }
            //Return the user
            return $user;
        } catch (Exception $e) {
            //Unexpected error
            return null;
        }
    }

	/**
	 * Saves user basic info
	 *
	 * @param \App\Eloquent\User $user
	 * @param array $data
	 * @return \App\Eloquent\UserBasicInfo|null
	 */
	public function saveBasicInfo($user = null, $data = [])
	{
		try {
			//Get the info of the user
			$basicInfo = $user->basicInfo;
			//No info found
			if($basicInfo == null) {
				//Create new info for the user
				$basicInfo = $user->basicInfo()->create($data);
			} else {
				//User already has info
				$basicInfo->fill($data);
				//Save info
				$basicInfo->save();
			}
			//Return basic info
			return $basicInfo;
		} catch (Exception $e) {
			//Unexpected error
			return null;
		}
	}

	/**
	 * Add a new education info to user
	 *
	 * @param \App\Eloquent\User $user
	 * @param array $data
	 * @return \App\Eloquent\UserEducation|null
	 */
	public function addEducation($user = null, $data = [])
	{
		try {
			//Add new education row and return
			return $user->educations()->create($data);
		} catch (Exception $e) {
			//Unexpected error
			return null;
		}
	}

	/**
	 * Add a new work info to user
	 *
	 * @param \App\Eloquent\User $user
	 * @param array $data
	 * @return \App\Eloquent\UserWork|null
	 */
	public function addWork($user = null, $data = [])
	{
		try {
			//Add new work row and return
			return $user->works()->create($data);
		} catch (Exception $e) {
			//Unexpected error
			return null;
		}
	}

	/**
	 * Edits an education row for a user
	 *
	 * @param null $user
	 * @param string $educationId
	 * @param array $data
	 * @return \App\Eloquent\UserEducation|null
	 */
	public function editEducation($user = null, $educationId = '', $data = [])
	{
		try {
			//Find the eduction row
			$educationRow = $user->educations()->findOrFail($educationId);
			//Update row
			$educationRow->fill($data);
			//Save and return row
			return $educationRow->save();
		} catch (Exception $e) {
			//Unexpected error
			return null;
		}
	}

	/**
	 * Delete Education row from user
	 *
	 * @param \App\Eloquent\User $user
	 * @param string $educationId
	 * @return bool
	 */
	public function deleteEducation($user = null, $educationId = '')
	{
		try {
			//Delete education and return
			return $user->educations()->findOrFail($educationId)->delete();
		} catch (Exception $e) {
			//Unexpected error
			return false;
		}
	}

	/**
	 * Edit a work item for a user
	 *
	 * @param \App\Eloquent\User $user
	 * @param string $workId
	 * @param array $data
	 * @return \App\Eloquent\UserWork|null
	 */
	public function editWork($user = null, $workId = '', $data = [])
	{
		try {
			//Find work row
			$workRow = $user->works()->findOrFail($workId);
			//Update row
			$workRow->fill($data);
			//Save and return row
			return $workRow->save();
		} catch (Exception $e) {
			//Unexpected error
			return null;
		}
	}

	/**
	 * Delete a work item
	 *
	 * @param \App\Eloquent\User $user
	 * @param string $workId
	 * @return bool
	 */
	public function deleteWork($user = null, $workId = '')
	{
		try {
			//Perform delete and return
			return $user->works()->findOrFail($workId)->delete();
		} catch (Exception $e) {
			//Unexpected error
			return false;
		}
	}

	/**
	 * Saves user details
	 *
	 * @param null $user
	 * @param array $data
	 * @return \App\Eloquent\UserDetails|null
	 */
	public function saveUserDetails($user = null, $data = [])
	{
		try {
			//Save the details and return
			return ($user->detail != null)?$user->detail->fill($data)->save():$user->detail()->create($data)->save();
		} catch (Exception $e) {
			//Unexpected error
			return null;
		}
	}
}