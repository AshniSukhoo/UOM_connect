<?php

namespace App\Repositories\Contracts;

/**
 * Interface PasswordResetRepositoryInterface
 *
 * @package App\Repositories\Contracts
 */
interface PasswordResetRepositoryInterface
{
    /**
     * Save token for user
     *
     * @param \App\Eloquent\User $user
     * @return \App\Eloquent\PasswordReset | null
     */
    public function saveTokenForUser($user);

}
