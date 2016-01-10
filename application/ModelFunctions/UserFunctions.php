<?php

namespace App\ModelFunctions;

/**
 * Class UserFunctions
 * @package App\ModelFunctions
 */
trait UserFunctions
{
    /**
     * Checks if two user models are equal
     *
     * @param \App\Eloquent\User $user
     * @return bool
     */
    public function is($user)
    {
        //Perform check and return
        return (get_class($this) == get_class($user) && $this->id == $user->id);
    }

    /**
     * Checks if two user models are not equal
     *
     * @param \App\Eloquent\User $user
     * @return bool
     */
    public function isNot($user)
    {
        //return inverse of is
        return !$this->is($user);
    }

    /**
     * Checks if user has input details
     *
     * @return bool
     */
    public function hasDetails()
    {
        //If details is not null then return true
        return $this->detail != null;
    }

    /**
     * Checks if user has work or eductions input
     *
     * @return bool
     */
    public function hasWorkOrEduction()
    {
        //Check and return
        return (($this->educations != null && $this->educations->count() > 0) || ($this->works != null && $this->works->count() > 0));
    }
}