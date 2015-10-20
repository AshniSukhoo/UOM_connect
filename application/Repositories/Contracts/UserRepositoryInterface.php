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
}