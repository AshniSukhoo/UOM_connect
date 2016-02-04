<?php

if (! function_exists('app')) {
    /**
     * Get the available container instance.
     *
     * @param  string  $make
     * @param  array   $parameters
     * @return mixed|\Illuminate\Foundation\Application
     */
    function app($make = null, $parameters = [])
    {
        //Get CI super object
        $ci = & get_instance();
        //Get the Container
        $app = $ci->bootioc->returnIOC();
        if (is_null($make)) {
            return $app;
        }
        return $app->make($make, $parameters);
    }
}

if(! function_exists('public_path')) {
	/**
	 * Get the public path and return
	 *
	 * @param string $path
	 * @return string
	 */
	function public_path($path = '')
	{
		//Get path to public
		return ($path == '')?realpath(__DIR__.'../../../public'):realpath(__DIR__.'../../../public/'.ltrim($path.'/'));
	}
}