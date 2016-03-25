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

    /**
     * Verify if token is valid
     *
     * @param string $code
     * @return \App\Eloquent\PasswordReset
     */
    public function verifyToken($code);

    /**
     * Delete token
     *
     * @param string $code
     * @return bool
     */
    public function deleteToken($code);
}
