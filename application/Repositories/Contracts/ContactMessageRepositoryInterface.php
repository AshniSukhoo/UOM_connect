<?php

namespace App\Repositories\Contracts;

/**
 * Interface ContactMessageRepositoryInterface
 *
 * @package App\Repositories\Contracts
 */
interface ContactMessageRepositoryInterface
{
    /**
     * Save new contact message
     *
     * @param array $details
     * @return \App\Eloquent\ContactMessage
     */
    public function saveMessage($details = []);
}
