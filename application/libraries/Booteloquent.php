<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

/**
 * Class Booteloquent
 */
class BootEloquent
{
    /**
     * Capsule manager
     *
     * @var
     */
    protected $capsule;

    /**
     * Create a new instance of
     * Booteloquent
     */
    public function __construct()
    {
        //Create new capsule instance
        $this->capsule = new Capsule;
        //Add default connection
        $this->addDefault();
        //Actual boot
        $this->loadEloquent();
    }

    /**
     * Add default connection to capsule
     */
    public function addDefault()
    {
        //Get the CI super object
        $ci = & get_instance();
        //Add connection
        $this->capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => $ci->db->hostname,
            'database'  => $ci->db->database,
            'username'  => $ci->db->username,
            'password'  => $ci->db->password,
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);
        // Set the event dispatcher used by Eloquent models... (optional)
        $this->capsule->setEventDispatcher(new Dispatcher(new Container));
    }

    /**
     * Load eloquent globally
     */
    public function loadEloquent()
    {
        // Make this Capsule instance available globally via static methods... (optional)
        $this->capsule->setAsGlobal();
        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $this->capsule->bootEloquent();
    }


}
