<?php


namespace App\ModelFunctions;

/**
 * Class PostFunctions
 * @package App\ModelFunctions
 */
trait PostFunctions
{
	/**
	 * Checks if a post contains any comments
	 *
	 * @return bool
	 */
	public function hasComments()
	{
		//return true if post contains comments
		return $this->comments()->count() > 0;
	}
}