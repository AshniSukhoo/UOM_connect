<?php

namespace App\Presenters;

/**
 * Class UserBasicInfoPresenter
 * @package App\Presenters
 */
trait UserBasicInfoPresenter
{
    /**
     * Get the emails attribute values
     *
     * @param string $value
     * @return \Illuminate\Support\Collection|null
     */
    public function getEmailsAttribute($value)
    {
        //Return as collection or null
        return ($value != '' && $value != null)?collect(json_decode($value, true)):null;
    }

    /**
     * Setting the emails attribute
     *
     * @param \Illuminate\Support\Collection $value
     */
    public function setEmailsAttribute($value)
    {
        //Json encode and return
        $this->attributes['emails'] = ($value != '' && $value != null)?json_encode($value->all()):'';
    }
}