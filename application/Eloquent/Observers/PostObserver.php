<?php


namespace App\Eloquent\Observers;

/**
 * Class PostObserver
 * @package App\Eloquent\Observers
 */
trait PostObserver
{

    public static function boot()
    {
        parent::boot();

        //
        static::creating(function($post)
        {
            exit('test2');
        });

        static::updating(function($obj)
        {
            exit('test3');
        });

        static::saving(function($obj)
        {
            exit('test4');
        });

        static::deleting(function($obj)
        {
            exit('test5');
        });

        static::deleted(function($obj)
        {
            exit('test6');
        });
    }

}
