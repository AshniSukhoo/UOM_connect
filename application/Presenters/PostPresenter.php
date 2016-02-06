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

}