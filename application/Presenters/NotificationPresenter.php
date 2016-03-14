<?php

namespace App\Presenters;

/**
 * Class NotificationPresenter
 * @package App\Presenters
 */
trait NotificationPresenter
{
    /**
     * Get the icon class
     *
     * @return string
     */
    public function getIconAttribute()
    {
        //Return the proper icon class
        switch($this->type) {
            case 'friended':
                return 'fa fa-user';
            default:
                return '';
        }
    }
}
