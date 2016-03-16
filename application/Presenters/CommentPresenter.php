<?php


namespace App\Presenters;

/**
 * Class CommentPresenter
 * @package App\Presenters
 */
trait CommentPresenter
{
	/**
	 * Get the comment in html form
	 *
	 * @return string
	 */
	public function getAsHtmlAttribute()
	{
		//Return body of comment with html tags
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
        return 'Comment';
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
        return $this->post->user->base_profile_uri.'/posts/'.$this->id;
    }
}
