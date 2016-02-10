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
	 * Checks if user has liked a post
	 *
	 * @param \App\Eloquent\Post $post
	 * @return bool
	 */
	public function likedPost($post = null)
	{
		//Check and return
		return ($post->likes()->where('user_id', $this->id)->count() == 1);
	}
}