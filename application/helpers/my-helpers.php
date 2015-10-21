<?php

/**
 * Return the Instance of the IOC container
 */
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