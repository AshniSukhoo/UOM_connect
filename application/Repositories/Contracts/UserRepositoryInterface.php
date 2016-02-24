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
	 * Get a single User using only
	 * his user ID
	 *
	 * @param string $userId
	 * @throws ModelNotFoundException
	 * @return \App\Eloquent\User|null
	 */
	public function findUser($userId);

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

	/**
	 * Edits an education row for a user
	 *
	 * @param \App\Eloquent\User $user
	 * @param string $educationId
	 * @param array $data
	 * @return \App\Eloquent\UserEducation|null
	 */
	public function editEducation($user = null, $educationId = '', $data = []);

	/**
	 * Delete Education row from user
	 *
	 * @param \App\Eloquent\User $user
	 * @param string $educationId
	 * @return bool
	 */
	public function deleteEducation($user = null, $educationId = '');

	/**
	 * Edit a work item for a user
	 *
	 * @param \App\Eloquent\User $user
	 * @param string $workId
	 * @param array $data
	 * @return \App\Eloquent\UserWork|null
	 */
	public function editWork($user = null, $workId = '', $data = []);

	/**
	 * Delete a work item
	 *
	 * @param \App\Eloquent\User $user
	 * @param string $workId
	 * @return bool
	 */
	public function deleteWork($user = null, $workId = '');

	/**
	 * Saves user details
	 *
	 * @param \App\Eloquent\User $user
	 * @param array $data
	 * @return \App\Eloquent\UserDetails|null
	 */
	public function saveUserDetails($user = null, $data = []);

	/**
	 * Send a friend request to user
	 *
	 * @param \App\Eloquent\User $sender
	 * @param \App\Eloquent\User $receiver
	 * @return bool
	 */
	public function sendFriendRequest($sender = null, $receiver = null);
}