<?php

namespace App\Repositories;

use App\Eloquent\PasswordReset;
use App\Repositories\Contracts\PasswordResetRepositoryInterface;
use Ramsey\Uuid\Uuid;

/**
 * Class PasswordResetRepository
 *
 * @package App\Repositories
 */
class PasswordResetRepository implements PasswordResetRepositoryInterface
{
    /**
     * Password reset model
     *
     * @var \App\Eloquent\PasswordReset
     */
    protected $passwordReset;

    /**
     * Create new instance of PasswordRepository service
     *
     * @return void
     */
    public function __construct()
    {
        //New up PasswordReset model
        $this->passwordReset = new PasswordReset;
    }

    /**
     * Save token for user
     *
     * @param \App\Eloquent\User $user
     * @return \App\Eloquent\PasswordReset | null
     */
    public function saveTokenForUser($user)
    {
        //Save a new token for the user
        $this->passwordReset->fill(['code' => Uuid::uuid4()])->user()->associate($user)->save();
    }
}
