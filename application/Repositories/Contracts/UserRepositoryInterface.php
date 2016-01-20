<?php

namespace App\Repositories\Contracts;

/**
 * Interface UserRepositoryInterface
 * @package App\Repositories\Contracts
 */
interface UserRepositoryInterface
{
    /**
     * Get a single User using
     * his user ID and user type
     *
     * @param $userId
     * @param $type
     * @return \App\Eloquent\User|null
     */
    public function getUser($userId, $type);

	/**
	 * Saves user basic info
	 *
	 * @param \App\Eloquent\User $user
	 * @param array $data
	 * @return \App\Eloquent\UserBasicInfo|null
	 */
	public function saveBasicInfo($user = null, $data = []);

	/**
	 * Add a new education info to user
	 *
	 * @param \App\Eloquent\User $user
	 * @param array $data
	 * @return \App\Eloquent\UserEducation|null
	 */
	public function addEducation($user = null, $data = []);

	/**
	 * Add a new work info to user
	 *
	 * @param \App\Eloquent\User $user
	 * @param array $data
	 * @return \App\Eloquent\UserWork|null
	 */
	public function addWork($user = null, $data = []);
}