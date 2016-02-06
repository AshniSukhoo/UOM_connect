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

if(! function_exists('generate_next_page_url')) {
	/**
	 * Generate a next page url for a paginator instance
	 *
	 * @param \Illuminate\Pagination\LengthAwarePaginator
	 * @return string|null
	 */
	function generate_next_page_url($paginator = null)
	{
		//Get CI super object
		$ci = &get_instance();
		//Return next page url or null
		return ($paginator != null && $paginator->hasMorePages())?
				str_replace(
					'/?',
					'?',
					$paginator->setPath(current_url())
							  ->appends(collect(($ci->input->get(NULL, TRUE) != false)?$ci->input->get(NULL, TRUE):[])->forget(['page'])->all())
							  ->nextPageUrl()
				)
				:null;
	}
}