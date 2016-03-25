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
	 * Returns the full profile uri of a user
	 *
	 * @return string
	 */
	public function getProfileUriAttribute()
	{
		//Return the full uri
		return base_url($this->base_profile_uri);
	}

    /**
     * Returns the base profile uri
     *
     * @return string
     */
    public function getBaseProfileUriAttribute()
    {
        return ($this->user_type == 'student')?'student-profile/'.$this->id:'lecturer-profile/'.$this->id;
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

    /**
     * Set password by encryption
     *
     * @param string $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        //Get CI super object
        $CI = & get_instance();
        //Encrypt password
        $this->attributes['password'] = $CI->auth->encryptPassword($value);
    }
}
