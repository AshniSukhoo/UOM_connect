<?php

namespace App\Repositories;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Eloquent\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

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
            return $this->user->where('user_type', '=', $type)->findOrFail($userId);
        } catch (Exception $e) {
            //Unexpected error
            return null;
        }
    }

    /**
     * Find user by email
     *
     * @param string $email
     * @return \App\Eloquent\User|null
     */
    public function findUserByMail($email)
    {
        try {
            //Try to find the user with the ID and type specified
            return $this->user->whereEmail($email)->firstOrFail();
        } catch (Exception $e) {
            //Unexpected error
            return null;
        }
    }

	/**
	 * Get a single User using only
	 * his user ID
	 *
	 * @param string $userId
	 * @throws ModelNotFoundException
	 * @return \App\Eloquent\User|null
	 */
	public function findUser($userId)
	{
		//Return user
		return $this->user->findOrFail($userId);
	}

    /**
     * Paginate the user's friends
     *
     * @param \App\Eloquent\User $user
     * @param int $numberPerPage
     * @return \Illuminate\Pagination\LengthAwarePaginator|null
     */
    public function paginateFriends($user = null, $numberPerPage = 10)
    {
        try {
            //Get CI super object
            $ci = & get_instance();
            //Calculate page
            $page = $ci->input->get('page') !== false? $ci->input->get('page'):1;
            //Return friends pagination
            $friends = $user->friends()->orderBy('created_at', 'desc')->skip($numberPerPage * ($page - 1))->take($numberPerPage)->get();
            //No items found
            if($friends->count() == 0) {
                //We return null
                return null;
            }
            return new LengthAwarePaginator(
                $friends,
                $user->friends()->count(),
                $numberPerPage,
                $page,
                [
                    'path' => current_url()
                ]
            );
        } catch (Exception $e) {
            dd($e->getMessage());
            //Unexpected error return nul
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

	/**
	 * Send a friend request to user
	 *
	 * @param \App\Eloquent\User $sender
	 * @param \App\Eloquent\User $receiver
	 * @return bool
	 */
	public function sendFriendRequest($sender = null, $receiver = null)
	{
		//Receiver has already had this request before
		if($receiver->receivedFriendRequests()->withTrashed()->where('sender', $sender->id)->count() > 0) {
			//Restore request and update to not notified
			$request = $receiver->receivedFriendRequests()->withTrashed()->where('sender', $sender->id)->restore();
			//Update info
			$request->update([
				'notified' => false
			]);
		} else {
			//New request
			//Add sender's request to receiver's list
			$receiver->receivedFriendRequests()->create([
				'sender' => $sender->id,
				'notified' => false,
			]);
		}
		//Return completed
		return true;
	}

	/**
	 * Cancels a friend request between users
	 *
	 * @param \App\Eloquent\User $sender
	 * @param \App\Eloquent\User $receiver
	 * @return bool
	 */
	public function  cancelFriendRequest($sender = null, $receiver = null)
	{
		//Remover request from receiver list
		$receiver->receivedFriendRequests()->where('sender', $sender->id)->delete();
		//Return completed
		return true;
	}

	/**
	 * Accept friend request from a user
	 *
     * @param \App\Eloquent\User $receiver
     * @param \App\Eloquent\User $sender
	 * @return bool
	 */
	public function acceptFriendRequest($receiver = null, $sender = null)
    {
        //Delete friend request first
        $receiver->receivedFriendRequests()->where('sender', $sender->id)->forceDelete();
        //Make users friends
        $receiver->friends()->attach($sender->id, [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        $sender->friends()->attach($receiver->id, [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        //Create notification for sender
        $sender->receivedNotifications()->create([
            'notifier' => $receiver->id,
            'content' => 'accepted your friend request',
            'url' => $receiver->base_profile_uri,
            'notified' => false,
            'type' => 'friended',
        ]);
        //Return completion of process
        return true;
    }

    /**
     * Ignore friend request from a user
     *
     * @param \App\Eloquent\User $receiver
     * @param \App\Eloquent\User $sender
     * @return bool
     */
    public function ignoreFriendRequest($receiver = null, $sender = null)
    {
        //Delete friend request
        $receiver->receivedFriendRequests()->where('sender', $sender->id)->delete();
        //Return completion of process
        return true;
    }

    /**
     * Un-friends two users
     *
     * @param \App\Eloquent\User $user1
     * @param \App\Eloquent\User $user2
     * @return bool
     */
    public function unfriendUsers($user1 = null, $user2 = null)
    {
        //Remove user2 from user1's friends
        $user1->friends()->detach($user2->id);
        //Remove user1 from user2's friends
        $user2->friends()->detach($user1->id);
        //Return results completed
        return true;
    }

    /**
     * Search for users using the keywords
     *
     * @param string $keywords
     * @param int $numberPerPage
     * @return \Illuminate\Pagination\LengthAwarePaginator|null
     */
    public function searchUsers($keywords = '', $numberPerPage = 10)
    {
        //Get CI super object
        $ci = & get_instance();
        //Calculate page
        $page = $ci->input->get('page') !== false? $ci->input->get('page'):1;
        //Get number of users
        $usersCount = $this->user->search($keywords)->count();
        //No users
        if($usersCount == 0) {
            //we return null
            return null;
        }
        //Get results
        $results = $this->user->search($keywords)->skip($numberPerPage * ($page - 1))->take($numberPerPage)->get();
        //No posts on this page
        if($results->count() == 0) {
            //Return null
            return null;
        }
        //Return paginator
        return (new LengthAwarePaginator(
            $results,
            $usersCount,
            $numberPerPage,
            $page,
            [
                'path' => current_url()
            ]
        ))->appends(['srch-term' => $keywords]);
    }

    /**
     * Paginate user notifications
     *
     * @param \App\Eloquent\User $user
     * @param int $numberPerPage
     * @return \Illuminate\Pagination\LengthAwarePaginator|null
     */
    public function paginateNotifications($user = null,  $numberPerPage = 10)
    {
        //Get CI super object
        $ci = & get_instance();
        //Calculate page
        $page = $ci->input->get('page') !== false? $ci->input->get('page'):1;
        //Get the number of notifications
        $notificationsCount = $user->receivedNotifications()->count();
        //No notifications
        if($notificationsCount == 0) {
            //we return null
            return null;
        }
        //Get results
        $results = $user->receivedNotifications()->orderBy('created_at', 'desc')->skip($numberPerPage * ($page - 1))->take($numberPerPage)->get();
        //No notifications on this page
        if($results->count() == 0) {
            //Return null
            return null;
        }
        //Return paginator
        return new LengthAwarePaginator(
            $results,
            $notificationsCount,
            $numberPerPage,
            $page,
            [
                'path' => current_url()
            ]
        );
    }

    /**
     * Paginate user invitations
     *
     * @param \App\Eloquent\User $user
     * @param int $numberPerPage
     * @return \Illuminate\Pagination\LengthAwarePaginator|null
     */
    public function paginateInvitations($user = null, $numberPerPage = 10)
    {
        //Get CI super object
        $ci = & get_instance();
        //Calculate page
        $page = $ci->input->get('page') !== false? $ci->input->get('page'):1;
        //Get the number of notifications
        $invitationsCount = $user->receivedFriendRequests()->count();
        //No notifications
        if($invitationsCount == 0) {
            //we return null
            return null;
        }
        //Get results
        $results = $user->receivedFriendRequests()->orderBy('created_at', 'desc')->skip($numberPerPage * ($page - 1))->take($numberPerPage)->get();
        //No notifications on this page
        if($results->count() == 0) {
            //Return null
            return null;
        }
        //Return paginator
        return new LengthAwarePaginator(
            $results,
            $invitationsCount,
            $numberPerPage,
            $page,
            [
                'path' => current_url()
            ]
        );
    }
}
