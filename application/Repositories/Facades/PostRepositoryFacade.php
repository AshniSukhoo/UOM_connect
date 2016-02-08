<?php

namespace App\Repositories\Facades;

use Ahir\Facades\Facade;

/**
 * Class PostRepositoryFacade
 * @package App\Repositories\Facades
 */
class PostRepositoryFacade extends Facade
{
	/**
	 * Get the connector name of main class
	 *
	 * @return string
	 */
	public static function getFacadeAccessor()
	{
		return 'App\Repositories\PostRepository';
	}
}