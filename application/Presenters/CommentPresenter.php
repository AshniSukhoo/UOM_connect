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
}