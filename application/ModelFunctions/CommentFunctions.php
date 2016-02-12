<?php

namespace App\ModelFunctions;

/**
 * Class CommentFunctions
 * @package App\ModelFunctions
 */
trait CommentFunctions
{
	/**
	 * Check if comments has likes
	 *
	 * @return bool
	 */
	public function hasLikes()
	{
		//Check and return
		return ($this->likes()->count() > 0);
	}
}