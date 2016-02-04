<?php

namespace App\Presenters;

/**
 * Class UserPresenter
 * @package App\Presenters
 */
trait UserPresenter
{
    /**
     * Get the full name of a user
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        //Concat first name and last name then return
        return $this->first_name.' '.$this->last_name;
    }

	/**
	 * Returns the profile uri of a user
	 *
	 * @return string
	 */
	public function getProfileUriAttribute()
	{
		//Return the uri
		return ($this->user_type == 'student')?base_url('student-profile/'.$this->id):base_url('lecturer-profile/'.$this->id);
	}

	/**
	 * Get the profile picture attribute
	 *
	 * @param string $value
	 * @return string
	 */
	public function getProfilePictureAttribute()
	{
		//Return profile picture
		return ($this->hasDetails() && $this->hasProfilePic())?$this->detail->profile_picture:base_url('img/profile-pictures/avatar.png');
	}
}