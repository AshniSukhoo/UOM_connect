<?php

use Illuminate\Container\Container;
use Illuminate\Support\Facades\App;

/**
 * Class Bootioc
 * @package App\libraries
 */
class Bootioc
{
    /**
     * Laravel IOC container
     *
     * @var \Illuminate\Container\Container
     */
    protected $ioc;

	protected $facades = [
		'PostRepo' => 'App\Repositories\Facades\PostRepositoryFacade',
	];

    /**
     * Create new instance of Bootioc
     */
    public function __construct()
    {
        //Register class loader
        Illuminate\Support\ClassLoader::register();
        //Create the IOC container
        $this->ioc = new Container;
        $this->ioc->bind('app', $this->ioc);
        Illuminate\Support\Facades\Facade::setFacadeApplication($this->ioc);
        //Execute TRegister
        $this->registerRepositories();
	    //Add facades to classes
	    $this->addFacades();
    }

    /**
     * Return the IOC container
     *
     * @return Container
     */
    public function returnIOC()
    {
        //Return the container
        return $this->ioc;
    }

    /**
     * Register repositories Interfaces
     *
     * @return void
     */
    public function registerRepositories()
    {
        //Bind UserRepository interface
        $this->ioc->bind('App\Repositories\Contracts\UserRepositoryInterface', 'App\Repositories\UserRepository');
        $this->ioc->bind('UserRepo', function($app) {
            return $app->make('App\Repositories\Contracts\UserRepositoryInterface');
        });

	    //Bind PostRepository interface
	    $this->ioc->bind('App\Repositories\Contracts\PostRepositoryInterface', 'App\Repositories\PostRepository');
	    $this->ioc->bind('PostRepo', function($app) {
		    return $app->make('App\Repositories\Contracts\PostRepositoryInterface');
	    });
    }

	/**
	 * Add aliases to facades
	 */
	public function addFacades()
	{
		//Loop through all facades defined
		foreach($this->facades as $facade => $trueClass) {
			//Add alias
			class_alias ($trueClass,$facade,true);
		}
	}

}