<?php

namespace App\Presenters;

/**
 * Class UserDetailsPresenter
 * @package App\Presenters
 */
trait UserDetailsPresenter
{
	/**
	 * Get the hobbies attribute
	 *
	 * @param $value
	 * @return \Illuminate\Support\Collection|null
	 */
	public function getHobbiesAttribute($value)
	{
		//Return hobbies
		return ($value != null && $value != '')?collect(json_decode($value, true)):null;
	}

	/**
	 * Set the hobbies attribute
	 *
	 * @param $value
	 * @return void
	 */
	public function setHobbiesAttribute($value)
	{
		//Json encode and set
		$this->attributes['hobbies'] = json_encode(explode(',', $value));
	}

	/**
	 * Get the hobbies as a list separated by comma
	 *
	 * @return string
	 */
	public function getHobbiesListAttribute()
	{
		//Transform to list
		return ($this->hobbies != null)?ltrim($this->hobbies->reduce(function($results, $item) {
			return $results.', '.$item;
		}), ', '):null;
	}

	/**
	 * Get the interests
	 *
	 * @param $value
	 * @return \Illuminate\Support\Collection|null
	 */
	public function getInterestsAttribute($value)
	{
		//Return collection
		return ($value != null && $value != '')?collect(json_decode($value, true)):null;
	}

	/**
	 * Set value of interest attribute
	 *
	 * @param $value
	 */
	public function setInterestsAttribute($value)
	{
		//Encode and set value
		$this->attributes['interests'] = json_encode(explode(',', $value));
	}

	/**
	 * Get interests attribute as list with comma separated
	 *
	 * @return string
	 */
	public function getInterestsListAttribute()
	{
		//Reduce to single string and return
		return ($this->interests != null)?ltrim($this->interests->reduce(function($results, $item) {
			return $results.', '.$item;
		}), ', '):null;
	}
}