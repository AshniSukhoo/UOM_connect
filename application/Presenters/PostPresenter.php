<?php


namespace App\Presenters;

/**
 * Class PostPresenter
 * @package App\Presenters
 */
trait PostPresenter
{
	/**
	 * Echoing post as html
	 *
	 * @return string
	 */
	public function getAsHtmlAttribute()
	{
		//Put line break in content
		return nl2br($this->content);
	}

    /**
     * Get the generic name of the object
     *
     * @return string
     */
    public function getObjectNameAttribute()
    {
        //Return name
        return 'Post';
    }

    /**
     * Get the generic name of the object
     *
     * @return string
     */
    public function getObjectNameLcAttribute()
    {
        //Lower case the name and return
        return strtolower($this->object_name);
    }

    /**
     * Returns the full profile uri of a user
     *
     * @return string
     */
    public function getUriAttribute()
    {
        //Return the full uri
        return base_url($this->base_profile_uri);
    }

    /**
     * Returns the base uri
     *
     * @return string
     */
    public function getBaseUriAttribute()
    {
        //Return url of post
        return $this->user->base_profile_uri.'/posts/'.$this->id;
    }
}
