<?php

namespace App\Presenters;

use Carbon\Carbon;

/**
 * Class PasswordResetPresenter
 *
 * @package App\Presenters
 */
trait PasswordResetPresenter
{
    /**
     * Check if token is expired
     *
     * @return bool
     */
    public function isExpired()
    {
        //Token is older than 48hr
        return $this->created_at->diffInHours(Carbon::now()) >= 48;
    }
}
