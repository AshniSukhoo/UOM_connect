<?php

namespace App\Services\Facades;

use Ahir\Facades\Facade;

/**
 * Class HtmlBuilderFacade
 * @package App\Services\Facades
 */
class HtmlBuilderFacade extends Facade
{
	/**
	 * Get the connector name of main class
	 *
	 * @return string
	 */
	public static function getFacadeAccessor()
	{
		return 'App\Services\HtmlBuilder';
	}
}