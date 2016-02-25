<?php

namespace App\ModelFunctions;

/**
 * Class UserFunctions
 * @package App\ModelFunctions
 */
trait UserFunctions
{
	/**
	 * Checks if two user models are equal
	 *
	 * @param \App\Eloquent\User $user
	 *
	 * @return bool
	 */
	public function is($user)
	{
		//Perform check and return
		return ($user != null && get_class($this) == get_class($user) && $this->id == $user->id);
	}

	/**
	 * Checks if two user models are not equal
	 *
	 * @param \App\Eloquent\User $user
	 *
	 * @return bool
	 */
	public function isNot($user)
	{
		//return inverse of is
		return !$this->is($user);
	}

	/**
	 * Checks if user has input details
	 *
	 * @return bool
	 */
	public function hasDetails()
	{
		//If details is not null then return true
		return $this->detail != null;
	}

	/**
	 * Checks if user has work or educations input
	 *
	 * @return bool
	 */
	public function hasWorkOrEduction()
	{
		//Check and return
		return ($this->hasEducations() || $this->hasWorks());
	}

	/**
	 *Checks if a user has educations input only
	 *
	 * @return bool
	 */
	public function hasEducations()
	{
		//Check and return
		return ($this->educations != null && $this->educations()->count() > 0);
	}

	/**
	 * Checks if as user has works input only
	 *
	 * @return bool
	 */
	public function hasWorks()
	{
		//Check and return
		return ($this->works != null && $this->works()->count() > 0);
	}

	/**
	 * Checks if a user has profile picture
	 *
	 * @return bool
	 */
	public function hasProfilePic()
	{
		//Check and return
		return ($this->hasDetails() && $this->detail->getOriginal('profile_picture') != null && $this->detail->getOriginal('profile_picture') != '');
	}

	/**
	 * Checks if user has liked a resource
	 *
	 * @param mixed $resource
	 * @return bool
	 */
	public function liked($resource = null)
	{
		//Check and return
		return ($resource->likes()->where('user_id', $this->id)->count() == 1);
	}

	/**
	 * Checks if two users are friends
	 *
	 * @param \App\Eloquent\User $user
	 * @return bool
	 */
	public function isFriendsWith($user = null)
	{
		//Perform check and return
		return ($user != null && $this->friends()->where('users.id', $user->id)->count() == 1);
	}

	/**
	 * Checks if two users are not friends
	 *
	 * @param \App\Eloquent\User $user
	 * @return bool
	 */
	public function notFriendsWith($user = null)
	{
		//Perform check and return
		return ($user != null && !$this->isFriendsWith($user));
	}

	/**
	 * Checks if this user has pending friend requests
	 *
	 * @return bool
	 */
	public function hasPendingFriendRequests()
	{
		//Perform check and return
		return ($this->receivedFriendRequests()->notNotified()->count() > 0);
	}

	/**
	 * Returns the number of pending friend requests for this user
	 *
	 * @return int
	 */
	public function pendingFriendRequests()
	{
		//Return count
		return ($this->receivedFriendRequests()->notNotified()->count());
	}

	/**
	 * Checks if this user has sent the other user a friend request
	 *
	 * @param \App\Eloquent\User $user
	 * @return bool
	 */
	public function hasSentFriendRequestTo($user = null)
	{
		//Check and return
		return ($this->sentFriendRequests()->where('receiver', $user->id)->count() == 1);
	}

	/**
	 * Checks if this user has received a friend request from the other user
	 *
	 * @param \App\Eloquent\User $user
	 * @return bool
	 */
	public function hasReceivedFriendRequestFrom($user = null)
	{
		//CHeck and return
		return ($this->receivedFriendRequests()->where('sender', $user->id)->count() == 1);
	}

	/**
	 * Checks if this user has some pending notifications
	 *
	 * @return bool
	 */
	public function hasPendingNotifications()
	{
		//Check and return
		return ($this->receivedNotifications()->notNotified()->count() > 0);
	}

	/**
	 * Return all pending notifications for this user
	 *
	 * @return int
	 */
	public function pendingNotifications()
	{
		//Return number of rows
		return ($this->receivedNotifications()->notNotified()->count());
	}
}